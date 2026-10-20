# Legacy-led V4 interface preview

This preview is intentionally narrower than previous concepts. It adapts the information architecture observed in:
- \`legacy-reference/app/Views/monsters/index.php\`
- \`legacy-reference/app/Views/monsters/detail.php\`
- \`legacy-reference/app/Views/partials/site_header.php\`
- \`docs/legacy-ui-audit.md\`

## Design decisions

- Stay with Bootstrap 5.3 while using restrained, practical application styles.
- Keep original use cases: searchable list, size/race/property filters, EXP calculator block, linked detail, combat attributes, location, skills, drops, related monsters.
- No faux marketing hero, numbered sidebars, meaningless KPIs, generated game artwork or fake calculator outputs.
- Temporary wordmark only until the original \`assets/logo.png\` can be provided.
- Sample names/levels/classifications in \`app.js\` are **unverified examples for layout review**. Blank stats are intentional.
- The EXP section is an interface shell; no fake output is computed.
- JS behaviors (filtering, pagination, navigation) are client-side design examples. The original monster page fetches \`api/monsters\` and calculates recommendations; parity requires API, controllers, and test fixtures.

## Test and review checklist

- Desktop: compact navigation, functional filter bar, readable table, details visible without many unrelated cards.
- Mobile: collapsible navigation, filter fields wrap, results display as rows rather than an overflowing table, detail sections stack.
- Search works on homepage and listing.
- Filter by size and race/property, sort and paginate the demo list.
- Existing image slots remain stable when the original image assets are missing.
- Empty values do not imply actual game data.

## Before replacing production UI

- Supply original logo and a minimal set of verified representative monster/item images.
- Obtain actual API schema and original EXP formula behavior.
- Validate translated labels, links and SEO route parity.
- Reimplement calculators module-by-module with golden fixture tests.
- Review visual design with the ROXPEDIA owner before merge.
