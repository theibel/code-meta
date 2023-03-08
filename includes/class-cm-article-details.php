<?php

namespace CodeMilitant\CodeMeta;

// defined( 'ABSPATH' ) || exit;

trait CM_Article_Details
{
    use CM_Meta_Base;

    public static $post_details = array();
    public static $getArticleDetails = array();

    public static function cm_get_article_details($id)
    {
        self::$post_details = self::getMetaBase($id);
        self::$getArticleDetails = self::cm_article_details(self::$post_details);
        return self::$getArticleDetails;
    }

    private static function cm_article_details($post_details)
    {
        $charlength = 320;
        $article = array();
        $article['ID'] = $post_details['ID'];
        $article['og_title'] = $post_details['post_title'];
        $article['post_content'] = $post_details['post_content'];
        $article_description = trim(html_entity_decode(wp_strip_all_tags(mb_substr($post_details['post_content'], 0, $charlength - 5), true)));
        $article['og_description'] = $article_description;
        $article['og_url'] = get_permalink($post_details['ID']);

        $article['og_type'] = $post_details['post_type'];
        switch ($article['og_type']) {
            case "post":
                //used for referencing a general item or concept
                $article['og_type'] = "article";
                $article['og_determiner'] = "a";
                break;
            case "page":
                //used for referencing a specific item such as a website page
                $article['og_type'] = "website";
                $article['og_determiner'] = "the";
                break;
            case "product":
                //used for referencing a specific item or concept
                $article['og_type'] = "product";
                $article['og_determiner'] = "an";
                break;
        }

        $article['og_published_date'] = $post_details['post_date'];
        $article['og_modified_date'] = $post_details['post_modified'];
        $article['og_author'] = get_the_author_meta('display_name', $post_details['post_author']);
        $article['author_id'] = $post_details['post_author'];

        if (!empty($post_details['post_category'])) {
            $post_cat_names = get_terms(array('include' => $post_details['post_category'], 'fields' => 'names'));
            $article_tags = implode(', ', array_merge($post_details['tags_input'], $post_cat_names));
        } else {
            if (!empty($post_details['tags_input'])) {
                $article_tags = implode(', ', $post_details['tags_input']);
            }
        }

        $unique_tags = array_unique(array_map('trim', explode(',', $article_tags)));
        sort($unique_tags, SORT_NATURAL | SORT_FLAG_CASE);
        $article['og_keywords'] = strtolower(implode(', ', $unique_tags));

        if ($post_details['post_type'] == 'product') {
            $article['wc_terms'] = get_the_terms($post_details['ID'], 'product_tag');
            $article['og_keywords'] = strtolower(join(', ', wp_list_pluck($article['wc_terms'], 'name'))) . ', ' . $article['og_keywords'];
            $article['og_product_name'] = strtolower($post_details['name']);
            $article['og_product_sku'] = strtolower($post_details['sku']);
            $article['og_product_price'] = $post_details['price'];
            $article['og_product_currency'] = $post_details['currency'];
            $article['og_product_availability'] = $post_details['stock_status'];
            $article['og_date_on_sale_from'] = $post_details['date_on_sale_from'];
            $article['og_date_on_sale_to'] = $post_details['date_on_sale_to'];
            if (!empty($post_details['attributes'])) {
                $article['og_product_color'] = strtolower(implode(', ', $post_details['attributes']['color']['options']));
                $article['og_product_size'] = strtolower(implode(', ', $post_details['attributes']['size']['options']));
            }
        }

        return $article;
    }
}
