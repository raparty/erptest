<?php
/**
 * Modern Pagination Helper
 * Creates Bootstrap 5 styled pagination with proper accessibility
 * 
 * @param int $current_page Current page number
 * @param int $total_items Total number of items
 * @param int $items_per_page Items to show per page
 * @param string $base_url Base URL for pagination links (without page parameter)
 * @param array $extra_params Additional query parameters to preserve
 * @return string HTML for pagination
 */
function generate_pagination($current_page, $total_items, $items_per_page = 10, $base_url = '', $extra_params = []) {
    if ($total_items <= $items_per_page) {
        return ''; // No pagination needed
    }
    
    $total_pages = ceil($total_items / $items_per_page);
    $current_page = max(1, min($current_page, $total_pages));
    
    // Build query string with extra parameters
    $query_parts = [];
    foreach ($extra_params as $key => $value) {
        if ($key !== 'page') {
            $query_parts[] = urlencode($key) . '=' . urlencode($value);
        }
    }
    $query_base = $base_url . (strpos($base_url, '?') === false ? '?' : '&');
    if (!empty($query_parts)) {
        $query_base .= implode('&', $query_parts) . '&';
    }
    
    $html = '<nav aria-label="Page navigation" style="margin-top: 20px;">';
    $html .= '<ul class="pagination justify-content-center">';
    
    // Previous button
    if ($current_page > 1) {
        $html .= '<li class="page-item">';
        $html .= '<a class="page-link" href="' . $query_base . 'page=' . ($current_page - 1) . '" aria-label="Previous">';
        $html .= '<span aria-hidden="true">&laquo; Previous</span>';
        $html .= '</a></li>';
    } else {
        $html .= '<li class="page-item disabled">';
        $html .= '<span class="page-link">&laquo; Previous</span>';
        $html .= '</li>';
    }
    
    // Page numbers
    $adjacents = 2;
    
    if ($total_pages <= 7) {
        // Show all pages
        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $current_page) {
                $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
                $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=' . $i . '">' . $i . '</a></li>';
            }
        }
    } else {
        // Show with ellipsis
        if ($current_page <= 3) {
            // Near start
            for ($i = 1; $i <= 5; $i++) {
                if ($i == $current_page) {
                    $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=' . $i . '">' . $i . '</a></li>';
                }
            }
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=' . $total_pages . '">' . $total_pages . '</a></li>';
        } elseif ($current_page >= $total_pages - 2) {
            // Near end
            $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=1">1</a></li>';
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            for ($i = $total_pages - 4; $i <= $total_pages; $i++) {
                if ($i == $current_page) {
                    $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=' . $i . '">' . $i . '</a></li>';
                }
            }
        } else {
            // In middle
            $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=1">1</a></li>';
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            for ($i = $current_page - $adjacents; $i <= $current_page + $adjacents; $i++) {
                if ($i == $current_page) {
                    $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
                } else {
                    $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=' . $i . '">' . $i . '</a></li>';
                }
            }
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
            $html .= '<li class="page-item"><a class="page-link" href="' . $query_base . 'page=' . $total_pages . '">' . $total_pages . '</a></li>';
        }
    }
    
    // Next button
    if ($current_page < $total_pages) {
        $html .= '<li class="page-item">';
        $html .= '<a class="page-link" href="' . $query_base . 'page=' . ($current_page + 1) . '" aria-label="Next">';
        $html .= '<span aria-hidden="true">Next &raquo;</span>';
        $html .= '</a></li>';
    } else {
        $html .= '<li class="page-item disabled">';
        $html .= '<span class="page-link">Next &raquo;</span>';
        $html .= '</li>';
    }
    
    $html .= '</ul>';
    $html .= '<div class="text-center text-muted" style="margin-top: 10px;">';
    $html .= 'Showing page ' . $current_page . ' of ' . $total_pages . ' (Total: ' . $total_items . ' items)';
    $html .= '</div>';
    $html .= '</nav>';
    
    return $html;
}
?>
