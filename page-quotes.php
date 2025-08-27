<?php

/**
 * Advanced Quotes Page Template - Multiple Tables
 * 
 * This template displays multiple customizable tables with dynamic columns
 * Supports unlimited products and flexible table structures
 */

get_header(); ?>

<main id="main" class="site-main quotes-page">
    <div class="container">
        <div class="quotes-content">
            <?php
            // Get customizable page title
            $page_title = get_theme_mod('quotes_page_title', 'Bảng Giá Sản Phẩm');
            ?>
            <h1 class="page-title"><?php echo esc_html($page_title); ?></h1>

            <div class="quotes-tables-container">
                <?php
                // Get all quote tables from customizer
                $quote_tables = function_exists('get_quote_tables') ? get_quote_tables() : array();

                if (!empty($quote_tables)) :
                    foreach ($quote_tables as $table_index => $table) :
                        $table_title = $table['title'];
                        $headers = $table['headers'];
                        $products = $table['products'];
                        $columns_count = count($headers);
                ?>

                        <div class="quotes-table-section" data-table="<?php echo esc_attr($table_index + 1); ?>">
                            <h2 class="table-title"><?php echo esc_html($table_title); ?></h2>

                            <div class="quotes-table-wrapper">
                                <table class="quotes-table" data-columns="<?php echo esc_attr($columns_count); ?>">
                                    <thead>
                                        <tr>
                                            <?php foreach ($headers as $header) : ?>
                                                <th><?php echo esc_html($header); ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $product) : ?>
                                            <tr>
                                                <?php
                                                // Ensure we don't exceed the number of headers
                                                for ($i = 0; $i < $columns_count; $i++) :
                                                    $cell_value = isset($product[$i]) ? $product[$i] : '';
                                                ?>
                                                    <td><?php echo esc_html($cell_value); ?></td>
                                                <?php endfor; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    <?php
                    endforeach;
                else :
                    ?>

                    <div class="no-quotes-message">
                        <p><?php _e('No quote tables configured. Please set up your quotes in the WordPress Customizer.', 'skylightpoly'); ?></p>
                        <p><a href="<?php echo esc_url(admin_url('customize.php?autofocus[panel]=quotes_panel')); ?>" class="customize-link"><?php _e('Configure Quotes', 'skylightpoly'); ?></a></p>
                    </div>

                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<style>
    /* Simple Quotes Page Styles - No Effects */
    .quotes-page {
        padding: 40px 0;
        background-color: #ffffff;
    }

    .quotes-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .page-title {
        text-align: center;
        margin-bottom: 40px;
        font-size: 32px;
        color: #333333;
        font-weight: 600;
    }

    .quotes-tables-container {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }

    .quotes-table-section {
        margin-bottom: 20px;
    }

    .table-title {
        font-size: 24px;
        color: #333333;
        margin-bottom: 20px;
        font-weight: 600;
        text-align: left;
    }

    .quotes-table-wrapper {
        margin-bottom: 20px;
        overflow-x: auto;
    }

    .quotes-table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
        font-family: Arial, sans-serif;
    }

    .quotes-table th,
    .quotes-table td {
        padding: 12px 16px;
        text-align: left;
        border: 1px solid #dddddd;
    }

    .quotes-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333333;
        font-size: 16px;
    }

    .quotes-table td {
        color: #555555;
        font-size: 15px;
    }

    .quotes-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .quotes-table tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }

    /* No quotes message */
    .no-quotes-message {
        text-align: center;
        padding: 40px 20px;
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }

    .no-quotes-message p {
        margin: 0 0 15px 0;
        color: #666666;
        font-size: 16px;
        line-height: 1.5;
    }

    .customize-link {
        display: inline-block;
        background: #007cba;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 500;
    }

    .customize-link:hover {
        background: #005a87;
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .quotes-page {
            padding: 20px 0;
        }

        .page-title {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .quotes-tables-container {
            gap: 0px;
        }

        .quotes-table-section {
            padding: 20px;
            margin: 0 10px;
        }

        .table-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .quotes-table {
            font-size: 14px;
            min-width: 500px;
        }

        .quotes-table th,
        .quotes-table td {
            padding: 12px 15px;
        }

        .quotes-table th {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .quotes-table-section {
            margin: 0 5px;
            padding: 15px;
        }

        .quotes-table {
            min-width: 400px;
            font-size: 13px;
        }

        .quotes-table th,
        .quotes-table td {
            padding: 10px 12px;
        }

        .page-title {
            font-size: 1.25rem;
        }

        .table-title {
            font-size: 1rem;
        }
    }
</style>

<?php get_footer(); ?>