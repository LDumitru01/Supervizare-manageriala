# Repository Guidelines

## Project Structure & Module Organization

- The main entry point is `index.html` in the repository root, served by XAMPP at `http://localhost/supervizare-manageriala/`.
- Keep additional front-end assets in subdirectories such as `css/`, `js/`, and `img/`. Use clear, feature-based naming (e.g., `js/dashboard.js`, `css/reporting.css`).
- If you add backend code (PHP or API endpoints), place it in dedicated folders like `api/` or `backend/` and avoid mixing server logic with static assets.

## Build, Test, and Development Commands

- No mandatory build step is currently required; open the project via XAMPP in a browser for manual testing.
- If you introduce tooling, prefer npm scripts such as:
  - `npm run dev` – local development server or bundler.
  - `npm run build` – production build (minification/bundling).
  - `npm test` – run automated tests.
Update this section when you add concrete commands.

## Coding Style & Naming Conventions

- Use 2-space indentation for HTML, CSS, JavaScript, and PHP files.
- Prefer descriptive, English names: `camelCase` for variables/functions, `PascalCase` for classes, and `kebab-case` for file names and CSS classes.
- Keep inline scripts/styles minimal; place logic in separate `.js` and `.css` files.

## Testing Guidelines

- Currently there is no enforced test framework; start with browser-based manual tests for key flows.
- When adding automated tests (e.g., Jest, PHPUnit), group them under `tests/` and mirror the source structure.
- Name tests after the feature or component under test (e.g., `DashboardNavigation.test.js`).

## Commit & Pull Request Guidelines

- Write concise, imperative commit messages (e.g., `Add dashboard filters`, `Fix navbar layout`).
- Each pull request should:
  - Describe the change, reasoning, and impact.
  - Reference related issues or tasks.
  - Include screenshots or GIFs for UI changes when helpful.

## Agent-Specific Instructions

- Respect this document’s structure and tone when modifying files.
- Prefer small, focused changes and keep new conventions consistent with existing ones.
