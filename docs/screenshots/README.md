# School ERP System - Screenshots

This folder contains screenshots of the School ERP System pages using Microsoft Fluent UI Design System.

## Color Palette
- **Azure Blue**: #0078D4 (Primary actions, headers, icons)
- **Slate**: #605E5C (Text, borders)
- **Soft White**: #FAF9F8 (Backgrounds)

## Flexbox Shell Architecture
The application uses a robust Flexbox shell:
- Body: `display: flex; flex-direction: column;` (full viewport height)
- Header: Fixed height, `flex-shrink: 0` (stays at top)
- App Shell: `flex: 1` (takes remaining space)
- Footer: `flex-shrink: 0` (stays at bottom)
- Sidebar: 260px width, collapsible on mobile
- Content: `flex: 1` (expands to fill available space)

## Screenshots

### 1. Login Page (login_page.png)
Modern login page with centered card layout, Fluent UI styling, and clean authentication form.

### 2. Demo Dashboard (demo_dashboard.png)
Complete dashboard view with sidebar navigation, module cards, and form examples showing the full layout.

### 3. Dashboard (dashboard_fluent_ui.png)
Main dashboard with module navigation cards using Fluent UI colors and shadows.

### 4. Admission Page (admission_fluent_ui.png)
Student admission management page with action buttons and data table.

### 5. Fees Manager (fees_manager_fluent_ui.png)
Fees management interface with search form and transaction history table.

## Features Implemented
- ✅ Consistent Microsoft Fluent UI color palette across all pages
- ✅ Robust Flexbox-based responsive layout
- ✅ Modern CSS variables for maintainability
- ✅ Proper spacing and typography
- ✅ Accessibility-focused design (keyboard navigation, ARIA labels)
- ✅ Dark mode support via CSS custom properties
- ✅ Shadow and depth system for visual hierarchy
- ✅ Responsive design with mobile breakpoints

## Updated Files
- **CSS Files**: assets/css/enterprise.css, assets/css/legacy-bridge.css
- **PHP Pages**: 158+ pages updated with Fluent UI colors
- **Color Replacements**:
  - #1c75bc → #0078D4 (Azure Blue)
  - #64748b → #605E5C (Slate)
  - #f2420a → #F7630C (Fluent Orange)
