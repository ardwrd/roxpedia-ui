# ROXPEDIA UI — Design study 02

A content-first, responsive interface concept for the independent Ragnarok X reference project **ROXPEDIA**.

This is **not the production application**. The initial concept was rejected because it resembled a generic SaaS/admin dashboard. V2 uses a compact game-reference layout instead: searchable tables, horizontal navigation, restrained artwork and faster paths to useful data.

## Preview locally

Serve the repository root using `python -m http.server 8000` and visit `http://localhost:8000`. No install step is necessary. Hash routes work on GitHub Pages.

## Prototype includes

- Homepage with quick database links, monster preview and utilities
- Search from any page (`/` keyboard shortcut) and dedicated monster filters
- Monster directory with element and size filtering, accessible row navigation
- Monster details, sample stats and clearly marked illustrative drop lists
- Generic stamina arithmetic calculator with validation
- Reserved routes for items, jobs and tracker
- Desktop/mobile responsive layouts, clear focus states and reduced-motion support

## Data integrity

All monster details, combat stats, zone names and drops in `app.js` are **mock fixtures** and must not be treated as verified game information. Sample creature illustrations are original simple SVG placeholders, not extracted Ragnarok game assets. Replace mock data only after validating the source and game version.

## Production direction

The rebuild masterplan uses Next.js + TypeScript + Tailwind CSS for the frontend and Laravel 13 for the API/admin. This static interface is solely for reviewing layout and information architecture before implementing production components. No production systems are altered.

## Deploy to GitHub Pages

In repository settings, under **Pages**, deploy from `main` and `/ (root)`. Then visit `https://ardwrd.github.io/roxpedia-ui/` once GitHub publishes the site.

ROXPEDIA is an independent fan resource and is not affiliated with Gravity Co., Ltd.