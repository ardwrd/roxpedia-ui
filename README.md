# ROXPEDIA UI — Bootstrap 5.3 Prototype

Experimental frontend for the ROXPEDIA Ragnarok X reference site. This version replaces the previous visual treatment with a compact, data-first interface and Bootstrap 5.3.8 components.

## Preview

GitHub Pages (when Pages deployment is enabled):
https://ardwrd.github.io/roxpedia-ui/

This is an independent frontend prototype. It does not modify the CodeIgniter 4 legacy application or production database.

## Technology

- Bootstrap 5.3.8, pinned CDN assets with integrity checks
- Custom CSS for ROXPEDIA identity and layout
- Vanilla JavaScript with hash-based routes for GitHub Pages
- No bundler or build command required

## Routes

- #/ — Homepage, global search, database directory
- #/monsters — Searchable monster list with element, size and sorting filters
- #/monsters/poring — Example detail layout; other demo monsters also work
- #/tools — Basic stamina subtraction demo
- #/items, #/jobs, #/tracker — Clearly labeled placeholders
- #/about — Project information

## Data accuracy

Monster names, levels, combat attributes, locations and drops are unverified illustrative fixtures. Never treat prototype values as current Ragnarok X game facts. There are no licensed or extracted game images in the interface.

## Run locally

Open index.html in a browser with an internet connection. Bootstrap loads via CDN. For local development you may also serve the folder from any static HTTP server.

## Next phases

1. Audit old CodeIgniter Views markup and original site navigation.
2. Build the remaining database and calculator screens.
3. Align visual assets and naming with ROXPEDIA's real brand.
4. Wire verified source data into API-driven views.
5. Move approved components into the final production stack after an architecture decision.

ROXPEDIA is an independent fan resource, unaffiliated with the owners of Ragnarok X.
