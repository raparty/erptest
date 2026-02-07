<?php
/**
 * school_setting_sidebar.php
 * Enterprise-Grade Professional Navigation Grid
 */
?>
<style>
    :root {
        --primary-blue: #0078D4;
        --text-dark: #334155;
        --border-light: #e2e8f0;
    }

    .switch_bar { padding: 20px 0; }

    .switch_bar ul {
        list-style: none; padding: 0; margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
        gap: 15px;
    }

    .switch_bar li { width: 100%; }

    /* The Professional Card */
    .switch_bar a {
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        height: 110px; padding: 10px;
        background: #ffffff;
        border: 1px solid var(--border-light);
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    /* Enterprise Hover State */
    .switch_bar a:hover {
        border-color: var(--primary-blue);
        background: #f8fafc;
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(28, 117, 188, 0.1);
    }

    .switch_bar a:hover .nav-icon-svg { fill: var(--primary-blue); }
    .switch_bar a:hover .label { color: var(--primary-blue); }

    /* Modern SVG Icon Styling */
    .nav-icon-svg {
        width: 32px; height: 32px;
        fill: #605E5C; /* Slate grey default */
        margin-bottom: 12px;
        transition: fill 0.3s ease;
    }

    /* Label Styling */
    .switch_bar .label {
        font-size: 11px;
        font-weight: 700;
        color: var(--text-dark);
        text-transform: uppercase;
        text-align: center;
        letter-spacing: 0.8px;
    }
</style>

<div class="switch_bar">
    <ul>
        <li>
            <a href="school_detail.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"/></svg>
                <span class="label">School Info</span>
            </a>
        </li>
        <li>
            <a href="class.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                <span class="label">Classes</span>
            </a>
        </li>
        <li>
            <a href="section.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg>
                <span class="label">Sections</span>
            </a>
        </li>
        <li>
            <a href="stream.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M20 18c1.1 0 1.99-.9 1.99-2L22 6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2H0v2h24v-2h-4zM4 6h16v10H4V6z"/></svg>
                <span class="label">Streams</span>
            </a>
        </li>
        <li>
            <a href="subject.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M18 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 4h5v8l-2.5-1.5L6 12V4z"/></svg>
                <span class="label">Subjects</span>
            </a>
        </li>
        <li>
            <a href="allocate_section.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M3.9 12c.5-1.3 1.1-2.4 2.1-3.4L4.6 7.2C3 8.7 1.9 10.2 1.3 12h2.6zm6.3-8.1C8.7 3 7.2 1.9 5.4 1.3l-1.4 2.6c1.3.5 2.4 1.1 3.4 2.1l1.4-1.4zM22.7 12c-.5 1.3-1.1 2.4-2.1 3.4l1.4 1.4c1.6-1.5 2.7-3 3.3-4.8h-2.6zM12 1.3v2.6c3.4 0 6.4 1.4 8.5 3.6l1.4-1.4C19.3 3.4 15.8 1.3 12 1.3z"/></svg>
                <span class="label">Alloc. Section</span>
            </a>
        </li>
        <li>
            <a href="allocate_stream.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                <span class="label">Alloc. Stream</span>
            </a>
        </li>
        <li>
            <a href="allocate_subject.php">
                <svg class="nav-icon-svg" viewBox="0 0 24 24"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9h-4v4h-2v-4H9V9h4V5h2v4h4v2z"/></svg>
                <span class="label">Alloc. Subject</span>
            </a>
        </li>
    </ul>
</div>
