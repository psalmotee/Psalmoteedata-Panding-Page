# PsalmoteeData

**A React-powered WordPress landing page with a standalone offline account and purchase interface, automated builds, and GitHub-based plugin updates.**

PsalmoteeData is a custom WordPress plugin that combines a modern React frontend with dedicated WordPress page templates and an existing offline account and purchase flow.

The project uses React and Vite to develop and build the landing page, while PHP integrates the compiled application into WordPress. It also provides a standalone template for the offline account page, with dedicated styling and JavaScript that preserve the existing purchase functionality.

The plugin is designed to work alongside an existing WordPress theme without requiring the entire website to be rebuilt. Its standalone templates provide independent page layouts while retaining the WordPress environment and the functionality required by the integrations.

GitHub Actions automates the production build and release packaging process, while Plugin Update Checker connects published GitHub Releases to the WordPress plugin update interface.

**Repository:** https://github.com/psalmotee/Psalmoteedata-Panding-Page

**Developer portfolio:** https://portfolio-psalmotee.netlify.app/

---

## Table of Contents

* [Overview](#overview)
* [Key Features](#key-features)
* [Technology Stack](#technology-stack)
* [Project Architecture](#project-architecture)
* [How the Integration Works](#how-the-integration-works)
* [Prerequisites](#prerequisites)
* [Local Development](#local-development)
* [Production Build](#production-build)
* [WordPress Installation](#wordpress-installation)
* [Automatic Updates](#automatic-updates)
* [Branding and Design](#branding-and-design)
* [Related WordPress Integration](#related-wordpress-integration)
* [Troubleshooting](#troubleshooting)
* [Contributing](#contributing)
* [Author](#author)

---

## Overview

PsalmoteeData is a React-based frontend project packaged as a WordPress plugin.

Rather than replacing WordPress or requiring the entire website to be rebuilt, the project integrates the compiled React application into an existing WordPress installation.

The frontend is developed using React, styled with Tailwind CSS and custom CSS, and compiled using Vite. A custom PHP plugin connects the production build to WordPress, registers a standalone page template, loads the required frontend assets, and provides a shortcode alternative.

The plugin also integrates with GitHub Releases through Plugin Update Checker, allowing published plugin versions to be detected and installed through the WordPress update interface.

### Project objectives

* Deliver a modern, responsive frontend experience.
* Keep the React application separate from WordPress theme files.
* Preserve the existing WordPress installation, administration, and unrelated pages.
* Avoid depending on the active theme's standard page layout for the landing page.
* Automate production builds and plugin packaging.
* Distribute versioned releases through GitHub.
* Simplify plugin updates through the WordPress administration dashboard.

---

## Key Features

### 1. React-powered frontend

The frontend is developed with React and organized into reusable components and page-level sections.

The available project structure includes:

* Home page
* FAQ page
* Header and hero sections
* Services and features sections
* How It Works section
* Testimonials
* Frequently Asked Questions
* Call-to-action section
* Footer
* FAQ search and category components
* Scroll progress indicator
* Back-to-top control

These components support a structured frontend that can be maintained and extended without placing the entire interface inside a single component.

### 2. WordPress plugin integration

The custom plugin integrates the production React build into WordPress.

It is responsible for:

* Registering the standalone landing page template.
* Loading compiled CSS and JavaScript assets.
* Reading asset information from Vite's build manifest.
* Mounting the React application inside the WordPress page.
* Providing a shortcode alternative for embedding the application.

### 3. Standalone page template

The plugin registers a page template named:

**Psalmotee React Landing Page (Standalone)**

When assigned to a WordPress page, this template bypasses the theme's normal header, footer, and page layout while retaining the WordPress `wp_head()` and `wp_footer()` hooks.

This makes it possible to present the React application without the standard Astra theme layout while keeping the rest of the WordPress website intact.

### 4. Standalone offline account and purchase page

The plugin provides a dedicated WordPress page template for the existing offline account and purchase flow.

The integration uses the existing `[vpaccount-offline]` shortcode to render the purchase interface, while the custom template and dedicated CSS provide a standalone page layout.

The offline page is designed to improve the presentation of the existing purchase experience without replacing its underlying business logic.

Its responsibilities include:

* Providing a dedicated WordPress page template.
* Integrating the existing `[vpaccount-offline]` shortcode.
* Loading the dedicated offline-page stylesheet and JavaScript where required.
* Improving the page layout and branding independently of the main React landing page.
* Preserving the existing service-selection, payment, verification, and related functionality.

The offline page and the React landing page are separate integrations within the same WordPress plugin.

**Important:** The existing purchase functionality depends on its original PHP implementation, HTML structure, element IDs and classes, JavaScript, AJAX handlers, and payment integrations. Changes to the page presentation must preserve the dependencies required by those operations.

### 5. Shortcode support

The plugin provides the following shortcode:

`[psalmoteedata_landing]`

This offers an alternative way to embed the React application in WordPress content.

The standalone template is the preferred approach when the objective is to display the landing page without the theme's normal page layout.

### 6. Manifest-based asset loading

The integration uses Vite's production manifest at:

`dist/.vite/manifest.json`

The plugin reads the generated asset information to determine which compiled CSS and JavaScript files should be loaded.

This approach supports Vite's hashed production filenames without requiring the filenames to be manually maintained in PHP.

### 7. Automated release packaging

GitHub Actions is used to automate the production build and release packaging process.

The workflow is designed to:

1. Check out the repository.
2. Set up the Node.js environment.
3. Install dependencies.
4. Build the React application.
5. Verify required plugin files.
6. Package the WordPress plugin.
7. Publish a versioned GitHub Release with the installable plugin ZIP.

### 8. GitHub-based WordPress updates

Plugin Update Checker is used to connect the WordPress plugin to its GitHub repository.

The intended release workflow allows WordPress to detect published versions and offer plugin updates through the WordPress administration interface.

---

## Technology Stack

| Technology                | Purpose                                         |
| ------------------------- | ----------------------------------------------- |
| React 18                  | Component-based frontend development            |
| Vite 5                    | Development server and production build tooling |
| Tailwind CSS 3            | Utility-first styling                           |
| React Router              | Frontend routing                                |
| Axios                     | HTTP requests                                   |
| Framer Motion             | Animation and motion effects                    |
| Lucide React              | Icon components                                 |
| React Icons               | Additional icon library                         |
| PHP                       | WordPress plugin integration                    |
| WordPress                 | Website platform and plugin environment         |
| Git and GitHub            | Version control and source hosting              |
| GitHub Actions            | Automated build and release workflow            |
| Plugin Update Checker 5.7 | GitHub-based plugin update integration          |

The project also uses custom CSS and a dedicated visual design system to control typography, colors, layout, and component styling.

---

## Project Architecture

The project combines a React application with a WordPress plugin.

The following is a conceptual representation of the important files and directories:

```text
Psalmoteedata-Panding-Page/
│
├── .github/
│   └── workflows/
│       └── release.yml
│
├── assets/
│   └── offline/
│       ├── css/
│       │   └── offline.css
│       ├── img/
│       │   └── psalmoteedata-logo.png
│       └── js/
│           └── offline.js
│
├── src/
│   ├── assets/
│   │   ├── psalmoteedata-logo.png
│   │   └── pdlogo.ico
│   │
│   ├── components/
│   │   ├── Header
│   │   ├── Hero
│   │   ├── Services
│   │   ├── Features
│   │   ├── HowItWorks
│   │   ├── Testimonials
│   │   ├── MiniFAQ
│   │   ├── FAQCategory
│   │   ├── FAQItem
│   │   ├── FAQSearch
│   │   ├── CTA
│   │   ├── Footer
│   │   ├── ScrollProgress
│   │   └── BackToTop
│   │
│   ├── data/
│   │   └── faqData.js
│   │
│   ├── pages/
│   │   ├── Home
│   │   ├── FAQ
│   │   ├── Contact
│   │   ├── About
│   │   ├── Privacy
│   │   └── Terms
│   │
│   ├── styles/
│   │   └── index.css
│   │
│   ├── App.jsx
│   │
│   └── main.jsx
│
├── templates/
│   ├── psalmotee-landing-template.php
│   └── psalmotee-offline-template.php
│
├── dist/
│   ├── assets/
│   ├── .vite/
│   │   └── manifest.json
│   └── index.html
│
├── plugin-update-checker/
│
├── psalmoteedata-landing.php
├── index.html
├── package.json
├── package-lock.json
├── vite.config.js
├── .gitignore
└── README.md
```

### Important files

#### `psalmoteedata-landing.php`

The main WordPress plugin file.

Its responsibilities include:

* Declaring plugin metadata and minimum environment requirements.
* Defining plugin directory and URL constants.
* Registering the standalone page template.
* Loading the React application's production assets.
* Reading Vite's manifest.
* Registering the `[psalmoteedata_landing]` shortcode.
* Integrating Plugin Update Checker with the GitHub repository.

#### `templates/psalmotee-landing-template.php`

The standalone WordPress page template.

It provides the container used to mount the React application and retains the WordPress head and footer hooks needed by WordPress and compatible plugins.

#### `src/main.jsx`

The React application's entry point.

This file initializes the frontend application and mounts it into the designated root element.

#### `src/styles/index.css`

The main stylesheet for shared styles, global presentation, and project-specific visual rules.

#### `vite.config.js`

Configures Vite to generate the production assets and manifest used by the WordPress plugin.

The production base path must match the plugin's installed asset directory.

#### `dist/`

Contains the compiled frontend files used by WordPress in production.

This directory must include the Vite manifest and the assets referenced by that manifest.

---

## How the Integration Works

The application follows a build-and-integrate architecture.

### Development stage

The frontend is developed using React, with Vite providing the development environment and production build tooling.

### Build stage

Vite compiles the source code into production assets and generates a manifest containing the asset filenames and related build information.

### WordPress integration stage

The WordPress plugin reads the manifest and enqueues the appropriate compiled CSS and JavaScript files.

The standalone page template provides the React mounting element:

```html
<div class="psalmotee-app">
    <div id="root"></div>
</div>
```

React mounts into `#root`, while `.psalmotee-app` provides a wrapper for application-specific styling and layout.

### Rendering stage

When a WordPress page uses the standalone template, the React application is displayed without the theme's normal header, footer, and page layout.

WordPress itself remains active, and other pages can continue using the existing theme.

### Update stage

When a new version is prepared, the release workflow builds and packages the plugin. The resulting ZIP is attached to a GitHub Release for distribution through the plugin's update integration.

---

## Prerequisites

### WordPress environment

The plugin metadata specifies these minimum requirements:

* **WordPress:** 6.0 or later
* **PHP:** 7.4 or later

A working WordPress installation is required.

### Frontend development environment

For local development and production builds, install:

* Node.js
* npm
* Git

The automated release workflow is designed to use Node.js 20.

For reproducible dependency installation, use the repository's `package-lock.json`.

---

## Local Development

### 1. Clone the repository

```bash
git clone https://github.com/psalmotee/Psalmoteedata-Panding-Page.git
```

### 2. Enter the project directory

```bash
cd Psalmoteedata-Panding-Page
```

### 3. Install dependencies

```bash
npm ci
```

This installs the dependencies recorded in `package-lock.json`.

### 4. Start the development server

```bash
npm run dev
```

Vite starts the development server using the script configured in `package.json`.

### 5. Make changes

Update the relevant React components, styles, pages, or assets inside `src/`.

For example:

* Modify page sections in the relevant components.
* Update shared styles in `src/styles/index.css`.
* Update branding assets in the appropriate assets directory.
* Adjust the Vite configuration when changing the production asset path or build behavior.

The development server is intended for frontend development. The production integration must be tested using a compiled build served through WordPress.

---

## Production Build

Generate the production frontend assets by running:

```bash
npm run build
```

The build should produce the compiled application inside `dist/`.

The expected manifest location is:

```text
dist/.vite/manifest.json
```

### Vite configuration

The production configuration uses the WordPress plugin's asset directory as its base path.

A representative configuration is:

```js
import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [react()],

  base: "/wp-content/plugins/psalmoteedata-landing/dist/",

  build: {
    manifest: true,

    rollupOptions: {
      input: "index.html",
    },
  },
});
```

The configuration should remain consistent with the directory where the plugin is installed.

### Build verification

After building, verify that:

* The build completes without errors.
* `dist/.vite/manifest.json` exists.
* The manifest references files that exist inside `dist/`.
* The compiled CSS and JavaScript are included in the plugin package.
* The WordPress plugin can locate the manifest.
* The React application renders correctly on the WordPress page.

**Important:** The `dist/` directory is part of the production plugin because WordPress serves the compiled frontend. The development source alone is not sufficient to run the integrated application.

---

## WordPress Installation

There are two practical installation methods.

### Method 1: Install the packaged plugin

1. Download the installable `psalmoteedata-landing.zip` asset from a published GitHub Release.
2. Sign in to WordPress administration.
3. Navigate to **Plugins → Add New Plugin**.
4. Select **Upload Plugin**.
5. Choose the downloaded ZIP.
6. Install and activate the plugin.

The ZIP must be the packaged WordPress plugin release asset, not GitHub's automatically generated source-code archive.

### Method 2: Install manually

If installing through cPanel or an FTP client, place the plugin directory at:

```text
wp-content/plugins/psalmoteedata-landing/
```

The installed plugin directory should contain the main PHP file, template, update-checker library, compiled assets, and Vite manifest.

After copying the files, activate the plugin through WordPress administration.

### Create the landing page

After activating the plugin:

1. Navigate to **Pages → Add New**.
2. Create or edit the page intended to display the landing page.
3. Locate the page's **Template** setting.
4. Select **Psalmotee React Landing Page (Standalone)**.
5. Publish or update the page.
6. Open the page on the frontend and verify that the React application loads.

The standalone template is intended to remove the normal Astra page layout from this page without changing the theme settings for the rest of the website.

### Alternative: Use the shortcode

If you prefer embedding the application in a page's content, use:

```text
[psalmoteedata_landing]
```

The shortcode should be used with the plugin's expected asset-loading behavior. For a page that needs to exclude the theme's standard header and footer, use the standalone template instead.

### Setting the homepage

To make the landing page the site's homepage:

1. Create and publish the landing page.
2. Assign the standalone template.
3. Navigate to **Settings → Reading**.
4. Set the homepage display to **A static page**.
5. Select the newly created landing page as the Homepage.
6. Save the changes.

This changes the site's homepage assignment; it does not replace WordPress or remove the theme from other pages.

### Configure the offline account page

The plugin also provides a dedicated template for the existing offline account and purchase flow.

To configure it:

1. Navigate to **Pages → Add New** in WordPress administration.
2. Create a page for the offline account or purchase interface.
3. Locate the page's Template setting.
4. Select the offline account template registered by the plugin, using its actual registered display name.
5. Publish or update the page.
6. Open the page on the frontend and verify that the offline purchase interface loads correctly.

The template uses the existing `[vpaccount-offline]` shortcode to display the purchase interface.

The dedicated template and presentation assets must be present in the installed plugin directory. The existing shortcode implementation and its dependencies must also remain available and compatible.

After configuration, test the existing service-selection and payment-related flows to confirm that the redesigned page has not affected the underlying functionality.

---

## Automatic Updates

The project uses GitHub Releases as its plugin distribution mechanism.

Plugin Update Checker is configured to monitor the project's GitHub repository and identify the installable plugin ZIP attached to a release.

The intended release asset name is:

```text
psalmoteedata-landing.zip
```

### Release workflow

The release process is designed around version tags.

A typical release follows this sequence:

1. Complete and test the changes.
2. Update the plugin version metadata where appropriate.
3. Commit and push the changes to GitHub.
4. Create and push a version tag, such as `v1.2.0`.
5. Allow GitHub Actions to run the production build.
6. Verify that the workflow completes successfully.
7. Confirm that the GitHub Release contains `psalmoteedata-landing.zip`.
8. Check that the release package contains the required plugin files and compiled assets.
9. Install or update the plugin on the WordPress website.

The workflow is designed to build the frontend, verify required files, package the plugin, and publish the release asset.

### Offline integration and release packaging

The offline page's PHP template, stylesheet, JavaScript, and other required assets must be included in the packaged plugin release.

Before publishing a new version, verify that:

* The offline template is present in the release ZIP.
* The dedicated offline assets are included at their expected paths.
* The existing shortcode and required dependencies remain available.
* The plugin loads the offline stylesheet and JavaScript under the intended conditions.
* The offline account and purchase page works after installation or update.
* The React landing page continues to work as expected.

The release workflow should be checked to ensure that required offline files are included in the package. If these files are not explicitly checked by the workflow, consider adding validation steps to catch missing files before publishing a release.

### Updating through WordPress

When a new compatible release is available and the update checker recognizes it, WordPress can present the update through its plugin update interface.

Before updating a live website, verify that the release package contains the correct plugin version and that the production build completed successfully.

**Release rule:** Publishing source changes to the repository is not, by itself, the same as publishing an installable plugin update. The release asset must be generated and attached correctly.

---

## Branding and Design

The frontend uses the PsalmoteeData brand identity.

The project includes a dedicated logo asset and a favicon asset. Shared styles are maintained in the frontend's stylesheet, with reusable components providing consistent presentation across page sections.

The design work includes:

* Shared header and footer branding.
* Reusable page sections and components.
* Consistent typography and color styling.
* Responsive frontend presentation.
* Reusable styles for links, buttons, and supporting text.

The branding used in the header and footer should consistently display **PsalmoteeData**.

When changing logo assets, verify that the import or public asset path matches the actual location of the image in the project.

The React frontend and its styles should remain isolated from the rest of the WordPress website wherever practical, particularly when the plugin is used alongside an existing theme such as Astra.

---

## Offline Account Integration

The plugin includes a dedicated presentation layer for the existing offline account and purchase functionality available through the `[vpaccount-offline]` shortcode.

Unlike the React landing page, the offline account page relies on the existing WordPress shortcode and its associated PHP, JavaScript, AJAX, and payment integrations.

### Template

The offline page template is located at:

`templates/psalmotee-offline-template.php`

It provides a dedicated layout for displaying the offline account and purchase interface within WordPress.

### Assets

The offline page uses dedicated presentation assets:

* `assets/offline/css/offline.css`
* `assets/offline/js/offline.js`
* `assets/offline/img/psalmoteedata-logo.png`

These assets are maintained separately from the React application's source code and production build.

### Shortcode

The existing purchase interface is rendered using:

`[vpaccount-offline]`

The shortcode remains responsible for providing the existing purchase functionality. The custom template and its presentation assets must remain compatible with that implementation.

### Development and maintenance

The offline page and React landing page should be maintained independently where practical.

When modifying the offline page:

* Preserve the existing purchase and payment logic.
* Retain the HTML IDs, classes, and JavaScript dependencies required by the existing functionality.
* Avoid changing unrelated PHP handlers or AJAX operations.
* Test service selection, payment-related operations, and other existing purchase flows after making changes.
* Verify that the dedicated stylesheet and JavaScript load correctly on the intended WordPress page.

### Plugin updates

The offline template and its associated assets are distributed as part of the WordPress plugin release when included in the release package.

Changes pushed to GitHub do not automatically modify the live website. A new release must be published and installed through the plugin's update mechanism.

Because plugin updates can replace files included in the package, changes to the offline template and its presentation assets should be maintained in this repository and tested before a release is deployed.

The distinction is important:

* **PsalmoteeData React landing page:** React frontend, Vite build, WordPress landing-page template, and `[psalmoteedata_landing]`.
* **Existing offline account flow:** `[vpaccount-offline]` and its associated purchase, verification, and payment functionality.

These integrations should not be treated as interchangeable. Changes to one should not unintentionally break the other.

---

## Troubleshooting

### The landing page is blank

Check the following:

1. Confirm that the plugin is activated.
2. Confirm that the page uses **Psalmotee React Landing Page (Standalone)**.
3. Verify that `dist/.vite/manifest.json` exists.
4. Confirm that the manifest references existing CSS and JavaScript files.
5. Open the browser developer console and check for JavaScript errors.
6. Check the browser's Network panel for failed asset requests.

### CSS or JavaScript files return 404 errors

Verify that the Vite production base path matches the actual plugin directory:

```text
/wp-content/plugins/psalmoteedata-landing/dist/
```

Also verify that the production build has been copied into the installed plugin directory.

### The Astra header or footer is still visible

Check that the intended page uses the standalone template rather than the default WordPress page template.

Also confirm that the custom template is present and registered by the activated plugin.

### The plugin cannot load the Vite manifest

Verify that this file exists:

```text
wp-content/plugins/psalmoteedata-landing/dist/.vite/manifest.json
```

If it is missing, rebuild the frontend and ensure the packaging workflow includes the entire required production build.

### The GitHub release does not appear as a WordPress update

Check that:

* The release exists in the configured repository.
* The release has the expected version.
* The release includes `psalmoteedata-landing.zip`.
* The ZIP contains the correct plugin directory structure.
* The plugin's update-checker configuration points to the intended repository and release asset.

A successful GitHub Actions run should be followed by a check of the actual release and ZIP contents.

### A new release installs incorrectly

Inspect the packaged ZIP before deploying it.

Confirm that the archive contains the plugin files at the expected directory level and includes the compiled frontend assets, template, update-checker library, and main plugin file.

Avoid publishing a release until these checks pass.

### The offline account page does not display

Check that:

The WordPress plugin is activated.
The correct offline page template is assigned to the page.
The template renders the existing [vpaccount-offline] shortcode correctly.
The shortcode implementation and its dependencies are available.
The browser console and PHP error logs do not show relevant errors.

### The offline page styling is missing

Check that:

assets/offline/css/offline.css exists in the installed plugin directory.
The PHP asset-loading logic references the correct path.
The stylesheet is loaded on the intended offline page.
The browser's Network panel does not show a 404 error for the stylesheet.

### The offline purchase functionality stops working after a redesign

Check the existing purchase implementation before changing its code.

Verify that required HTML IDs and classes, JavaScript dependencies, AJAX handlers, and payment integrations have not been removed or altered. Test the affected purchase flow after restoring any required dependencies.

Do not assume that a visual styling problem requires changes to the underlying payment logic.

---

## Contributing

Contributions, improvements, and bug reports are welcome.

When working on the project:

1. Create a branch for your changes.
2. Keep frontend components reusable and organized.
3. Avoid committing local dependency folders such as `node_modules/`.
4. Test the production build before preparing a release.
5. Verify the WordPress integration after changing the template or asset-loading logic.
6. Ensure the release workflow packages the compiled frontend.
7. Test the resulting plugin ZIP before deploying it to a live site.

### Suggested development workflow

```bash
git checkout -b feature/your-change

npm ci

npm run dev

npm run build

git status
```

Review the changes, run the relevant tests, and commit only the intended project files.

---

## Author

**Psalmotee-Tech**

* Portfolio: https://portfolio-psalmotee.netlify.app/
* GitHub repository: https://github.com/psalmotee/Psalmoteedata-Panding-Page

---

*PsalmoteeData brings together a modern React frontend and WordPress integration, with an automated release workflow designed to simplify deployment and ongoing maintenance.*
