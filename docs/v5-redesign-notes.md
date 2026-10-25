# ROXPEDIA V5 — database-first redesign

## Scope and structure

- Static frontend prototype using Bootstrap 5.3.8, from the reference app's database and information architecture.
- Landing page focuses on product modules rather than a marketing banner.
- Monster Database displays a compact table for desktop and readable monster rows on mobile, with filters and sort.
- Detail pages preserve attributes, skills, drop items, nearby monsters and game imagery slots.
- "Tools & calculators" links to the live functionality until original scripts and backend can be safely migrated.
- Genuine monster sprite URLs from the user's live ROXPEDIA site are reused; image load failures show a readable fallback.
- Theme choice is local and persists with localStorage.
- Language choice matches the **actual live language options**: EN English and ID Indonesia. It updates navigation, search, labels, form controls, page titles, help text and footer immediately; preserves the active route and filters; persists locally and as a \`?lang=en|id\` query parameter.
- Monster names, skill names and item names remain game data and are not machine-translated. Verified localized record fields require the live API.
- The page includes explicit prototype data/source disclosures.

## Reviewed references

- \`legacy-reference/app/Views/monsters/index.php\`
- \`legacy-reference/app/Views/monsters/detail.php\`
- \`legacy-reference/app/Views/partials/site_header.php\`
- \`legacy-reference/public/assets/js/theme-toggle.js\`
- https://roxpedia.com/ and https://roxpedia.com/?lang=id
- https://roxpedia.com/monsters and https://roxpedia.com/monsters/detail/10108

## Limitations and safeguards

- In-page demo records are a small subset of the legacy/live catalog, **not a complete API**. First page values and the Argiope detail are snapshots from publicly indexed pages; they may not reflect the latest patch.
- Real EXP formula, party / Odin outputs, boss trackers, and production workflows are not simulated.
- Locale persistence and frontend translation are independent from the backend CI4 language session.
- No image assets are bundled and source \`legacy-reference/\` is not modified.
- Browser pixel-level/mobile QA and original API schema validation remain outstanding.

## Acceptance checks

1. Open homepage, click Monster Database, filter and sort; paginate sample records.
2. Open Argiope, validate combat, drops, spawn and related monsters.
3. Switch EN / ID from each route and verify UI stays on the route with filters persisted.
4. Reload with \`?lang=id#/monsters\` to confirm locale initialization.
5. Toggle light/dark and reload; ensure no missing interface labels.
6. Confirm mobile collapsible menu, list rows and responsive details.
7. Compare production page outputs before any production migration.
