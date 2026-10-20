# ROXPEDIA Legacy UI Audit — 20 October 2026

Source: `legacy-reference/` in `ardwrd/roxpedia-ui`. This report is based on the committed repository tree and direct inspection of representative CodeIgniter views. It is **not** a complete executable audit of the original CodeIgniter backend.

## Inventory

- 51 PHP view files including 7 under error pages; 44 excluding error pages.
- 18 CSS files, of which 16 are Bootstrap distribution variants (CSS and source-map files not counted here).
- 7 JavaScript files, of which 6 are Bootstrap distribution variants.
- Non-framework CSS: `roxpedia-theme.css`, `theme-toggle.css`.
- Non-framework JS: `theme-toggle.js`.
- Image folder deliberately omitted; expected image paths can be read from PHP views.
- No `app/Views/home/index.php` is present in this tree. The production homepage route/view should be inventoried before attempting exact homepage parity.

## Core observations

### Shared shell
- `app/Views/partials/site_header.php` contains the original image logo (`assets/logo.png`) and About, Documentation, Support navigation.
- `site_footer.php` contains copyright and game IP attribution.
- `roxpedia-theme.css` is intentionally nearly empty; design styles are primarily Bootstrap utilities and inline per-page styles.
- `theme-toggle.js` supports light/dark using `data-bs-theme` and localStorage. Whether the toggle is mounted on every view requires route-by-route verification.

### Monster Database
Source: `app/Views/monsters/index.php`
- Bootstrap 5.3.3, not an older custom framework.
- Server GET filters for search, size, race/property.
- Contextual EXP Calculator with character level, party size, unique classes, world level, Odin and other options.
- Best Matches / recommendations.
- Monster result grid, count, pagination, API-backed client updates (`api/monsters`).
- Significant page-local JavaScript (multiple inline script tags; roughly 31 KB).

### Monster Detail
Source: `app/Views/monsters/detail.php`
- Original monster artwork at `assets/img/monster/{id}.png`, with fallback placeholder.
- Level, Max HP, Base EXP, Job EXP and Zeny summary.
- Combat Attributes, Spawn Location, Monster Skills, Monster Drop List, nearby-level monsters.
- Item detail and related monster links.
- Missing art must not be replaced with fictitious monster portraits.

### Items & Jobs
- `items/detail.php`: image/icon, item attributes, sell and vending prices, card effects, awakening effects, crafting and dismantle relationships, dropped-by information.
- `jobtree/index.php`: search, job cards, pagination, job progression artwork.
- `jobtree/detail.php`: rich details requiring separate UX analysis before implementation.

### MVP/Mini, Raids & Trackers
- `mvpmini_database/index.php` has async updates, search and pagination.
- `mvpmini_database/detail.php` has ranked and rare drops plus nearby-level related bosses.
- `raid/detail.php` uses nested stage/difficulty tabs, accordions and rewards.
- `mvpminitrackers/index.php` contains create/join room, characters, boss timers and attempts, with multiple backend fetch actions and interval-based updates.

### Calculators
- `refinesim/index.php` contains a substantial inline JS implementation (approx. 62 KB).
- `petsimulator/index.php` contains EXP/evolution/advance/release modules, uses jQuery and substantial inline JS.
- Other separate calculator views include enchant conversion, refine, upgrade, equipment transfer, rare item tax, shadowsmelt, etc.

## Specific problems with V3 prototype

1. Removed substantial data richness from monster records and their detail pages.
2. Replaced original game artwork with two-letter initials.
3. Added numbered navigation and branding treatments absent from the existing reference.
4. Used different interactions than production-style filtering and recommendation flows.
5. Used unverified example combat/drop data; avoid this in future previews.
6. Did not accommodate nested tools and complex stateful pages.

## Recommended Bootstrap 5.3 redesign strategy

**Do not create a generic SaaS dashboard or ornamental landing page.**

1. Preserve original logo/header relationships, route hierarchy and terminology.
2. Design `Monster Database` as the reference vertical slice before homepage redesign.
3. Keep search/filter + EXP calculator + best matches + result listing, but make the information hierarchy less card-heavy.
4. Monster Detail needs image area, compact metrics, combat attribute tables, skills, spawn area, drop list and related monsters.
5. Reserve explicit image aspect-ratio slots and true placeholders until authentic game assets are provided.
6. Keep calculation algorithms and server contracts intact; only refactor their UI after parity testing.
7. Prefer Bootstrap defaults plus a small, maintainable component/token stylesheet. Avoid gratuitous gradients, unrelated icons, numbered sidebars and marketing slogans.
8. Mobile acceptance: no horizontal overflow, clear filter access, usable tables/cards, touch targets, no hidden critical calculator controls.

## Next implementation milestone (V4)

- Prepare a separate preview branch, not direct production deployment.
- First build Monster Database and Monster Detail screens faithfully from legacy information architecture.
- Add missing-state/asset fallbacks with clear prototype labels, without fabricated gameplay statistics.
- Review source and visuals before merging to `main`.
- After approval, reuse components for MVP/Mini and Jobs; postpone calculator logic migration.

## Known gaps

- Main legacy homepage/index template is absent from the uploaded `app/Views` inventory.
- Original logo, monster sprites, item icons and fonts are not available in `legacy-reference/public/assets/images`.
- Controllers, helpers, languages and API response contracts were not uploaded; runtime behavior and all dynamic fields cannot be independently verified.
- Several scripts depend on third-party CDNs or are embedded inline in PHP, so a `public/assets/js` folder alone does not describe all frontend behavior.

No production backend or original legacy files were modified by this audit.
