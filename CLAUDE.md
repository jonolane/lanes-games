# CLAUDE.md — Voyage (Laravel Project)

## Project Overview
Voyage is a Laravel 12 game platform where users create and play interactive decision-based games (e.g., "This or That", "Brackets"). Users authenticate via Google OAuth, email/password, or enter as guests. The app is deployed on Laravel Cloud with a PostgreSQL database.

## Tech Stack
- **Backend:** Laravel 12, PHP 8.4
- **Frontend:** Blade templates, Alpine.js, Tailwind CSS
- **Database:** PostgreSQL (Laravel Cloud), SQLite (local)
- **Auth:** Laravel Breeze + Laravel Socialite (Google, Facebook)
- **Deployment:** Laravel Cloud (GitLab repo, auto-deploy on push to main)
- **Assets:** Vite

## Project Structure

### Layouts
- `resources/views/layouts/app.blade.php` — Authenticated layout (header with VOYAGE brand, New Game button, avatar dropdown, footer with copyright)
- `resources/views/layouts/guest.blade.php` — Auth pages layout (login, register, forgot password)
- `resources/views/welcome.blade.php` — Landing page (standalone, not using a layout, has animated pirate ship, stars, Log In / Enter as Guest buttons)

### Key Blade Components (`resources/views/components/`)
- `loader.blade.php` — Ship wheel spinner, shows on navigation (pure JS, no Alpine), uses `pageshow`/`pagehide` events
- `toast.blade.php` — Global toast notification system, uses `window.addEventListener('toast')`, sessionStorage deduplication with timestamp keys
- `ship.blade.php` — Animated pirate ship SVG (colored sails, sun flag, blue waves)
- `modal.blade.php` — Reusable modal with Alpine.js, centered with flex
- `toast` is placed outside flex containers in layouts (critical for `fixed` positioning to work)
- `loader` is placed as first child of `<body>` in both layouts

### Game Architecture
Games follow a consistent pattern:

**Database Models:**
- `Game` — master list of game types (slug, name). Seeded via `GameSeeder`
- `UserGame` — a user's instance of a game (belongs to User and Game, has title, settings JSON, has many entries)
- `ThisOrThatEntry` / entries — individual entries for a game (label field)

**Adding a new game requires:**
1. Add to `GameSeeder.php` `$games` array
2. Create controller (e.g., `BracketsController.php`)
3. Add routes to `web.php`
4. Create views in `resources/views/games/{slug}/create.blade.php` and `play.blade.php`
5. Run `php artisan db:seed --class=GameSeeder --force` on production

**Existing games:**
- `this-or-that` — Controller: `ThisOrThatController.php`, 6-50 entries, elimination-style play
- `brackets` — Controller: `BracketsController.php`, 16 entries (fixed), tournament bracket play

### Routes Structure (`routes/web.php`)
- `/` — Welcome page (redirects to dashboard if authenticated)
- `/dashboard` — Main dashboard showing user's games
- `/games/create` — Game type selection page
- `/games/{slug}/create` — Create form for specific game
- `/games/{slug}/{userGame}/edit` — Edit a game
- `/games/{slug}/{userGame}/play` — Play a game
- `/games/{userGame}` (DELETE) — Delete a game
- `/guest` (POST) — Create guest account

### Routes Structure (`routes/auth.php`)
- Login and register routes are OUTSIDE the `guest` middleware group (to allow guest users to access them)
- Password reset routes remain inside `guest` middleware
- Auth routes (logout, verify email, etc.) inside `auth` middleware

### Controllers
- `app/Http/Controllers/Auth/OAuthController.php` — Google/Facebook OAuth, converts guest accounts on OAuth login
- `app/Http/Controllers/Auth/GuestController.php` — Creates guest user accounts
- `app/Http/Controllers/Auth/AuthenticatedSessionController.php` — Login, redirects non-guest authenticated users to dashboard
- `app/Http/Controllers/Auth/RegisteredUserController.php` — Registration, converts guest accounts on register
- `app/Http/Controllers/DashboardController.php`
- `app/Http/Controllers/GameController.php` — Game type selection
- `app/Http/Controllers/ThisOrThatController.php`
- `app/Http/Controllers/BracketsController.php`

## Design System

### Color Palette (Dark Theme — primary)
- Background: `#0a0a0a` (body), `#161615` (cards/surfaces)
- Text primary: `#EDEDEC`
- Text secondary: `#A1A09A`
- Text muted: `#706f6c`
- Borders: `#3E3E3A` (dark), `#19140035` (light)
- Hover borders: `#62605b`
- Input backgrounds: `#1f1f1f`, hover `#2a2a2a`, focus `#2e2e2e`
- Card shadows: `shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)]` (light), `dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d]` (dark)

### Typography
- Brand font: `font-brand` (My Soul from Google Fonts)
- Body font: Instrument Sans from Bunny Fonts
- Both fonts loaded in layout heads

### Component Patterns
- Rounded corners: `rounded-sm` (not rounded-md or rounded-lg)
- Buttons use border styling with hover border changes, not background fills
- Button hover effects: seafoam green (`hover:bg-[#134e45] hover:border-[#2dd4a8]`) or blue (`hover:bg-[#133050] hover:border-[#2da8d4]`)
- Game cards on dashboard: centered title, entry count, Play/Edit/Delete action buttons with SVG icons and colored hover states
- Forms use `<x-text-input>`, `<x-input-label>`, `<x-input-error>` components
- No `<form>` wrapping issues — Alpine handles interactivity, forms use standard POST/PUT/DELETE

### Responsive Breakpoints
- Mobile: default (< 640px)
- Tablet: `sm:` (640px), `md:` (768px), `lg:` (1024px)
- Desktop: `xl:` (1280px+)
- Note: `lg:` (1024px) is treated as TABLET for brackets game (iPad Pro), not desktop. Desktop starts at `xl:`.

### Toast System
- Dispatch: `$dispatch('toast', { message: '...', key: '{{ now()->timestamp }}' })`
- Use `session('toast')` flash key (not `session('status')`) to avoid conflicts with Laravel's auth system
- Always wrap in `setTimeout(() => ..., 300)` for page-load toasts
- Toast component uses sessionStorage with timestamp key for deduplication

### Loader
- Pure vanilla JS (no Alpine) — critical for back/forward cache compatibility
- Shows after 300ms delay on link clicks and form submissions
- Uses `pageshow`/`pagehide` events to handle browser back button
- The ship wheel SVG is self-contained in the component

## User System

### User Model Fields
- Standard: name, email, password, email_verified_at
- OAuth: provider_name, provider_id, avatar
- Guest: is_guest (boolean, default false)
- `$fillable`: name, email, password, is_guest

### Guest Users
- Created via `GuestController@store` with random email (`guest_xxx@guest.local`)
- `is_guest = true` flag
- Always logged in with `remember: true`
- Can be converted to real accounts (both email/password and OAuth)
- Cleaned up by `CleanupGuests` artisan command (scheduled daily, uses `created_at` threshold)
- Guest users see "Create Account" and "Log In" in avatar dropdown instead of "Profile" and "Log Out"
- Profile page hidden from guests

### Auth Flow
- All logins use `remember: true` (hidden input in login form, `Auth::login($user, true)` in OAuth)
- `AuthenticatedSessionController@create` redirects non-guest authenticated users to dashboard
- Login/register routes are outside `guest` middleware to allow guest user access
- `bootstrap/app.php` middleware config is default (empty)

## Database

### Migrations
Located in `database/migrations/`. Create new migrations for structural changes (new tables, new columns). Never for data — use seeders for that.

### Seeders
- `GameSeeder.php` — Contains all game types in a `$games` array. Uses `updateOrCreate`. Add new games here.
- Run on production: `php artisan db:seed --class=GameSeeder --force`
- Run via Laravel Cloud Commands tab in dashboard

## Deployment (Laravel Cloud)

### Commands
- Run artisan commands via Laravel Cloud dashboard → Commands tab
- Migrations run automatically on deploy
- Seeders must be run manually after deploy: `php artisan db:seed --class=GameSeeder --force`

### Scheduled Tasks
- Enable "Scheduler" toggle in Laravel Cloud dashboard for `guests:cleanup` to run daily
- `CleanupGuests` command registered in `routes/console.php`

## Common Gotchas
- `fixed` positioning breaks inside flex containers — place fixed-position elements (toast, loader) as direct children of `<body>`, outside flex wrappers
- `x-cloak` requires `[x-cloak] { display: none !important; }` in `app.css` (placed BEFORE `@tailwind` directives)
- Alpine `x-for` template content loads after static HTML — use `x-cloak` on parent to prevent flash of unstyled content
- Browser back button serves cached pages — loader uses `pageshow`/`pagehide` vanilla JS (not Alpine) to handle this
- `@json` in `x-data` attributes breaks if data contains quotes — use `<script>` block with global variables instead
- Session flash data (`session('status')`) can be re-flashed by Laravel's auth system — use custom keys like `session('toast')`
- Chrome autofill styling override in `app.css` for dark theme inputs
- View cache: always run `php artisan view:clear` after template changes if behavior seems stale