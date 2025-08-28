<?php

/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ($comments_number == 1) {
                printf('Một bình luận về &ldquo;%s&rdquo;', get_the_title());
            } else {
                printf(
                    '%1$s bình luận về &ldquo;%2$s&rdquo;',
                    number_format_i18n($comments_number),
                    get_the_title()
                );
            }
            ?>
        </h3>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'custom_blue_orange_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_pagination(array(
            'prev_text' => '← Bình luận cũ hơn',
            'next_text' => 'Bình luận mới hơn →',
        ));
        ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments">Bình luận đã đóng.</p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'         => 'Để lại bình luận',
        'title_reply_to'      => 'Trả lời %s',
        'cancel_reply_link'   => 'Hủy trả lời',
        'label_submit'        => 'Gửi bình luận',
        'comment_field'       => '<p class="comment-form-comment"><label for="comment">Bình luận *</label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="Viết bình luận của bạn tại đây..."></textarea></p>',
        'fields'              => array(
            'author' => '<p class="comment-form-author"><label for="author">Tên *</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" maxlength="245" required="required" placeholder="Tên của bạn" /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">Email *</label><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" maxlength="100" aria-describedby="email-notes" required="required" placeholder="email@cua-ban.com" /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">Website</label><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" maxlength="200" placeholder="https://website-cua-ban.com" /></p>',
        ),
        'class_submit'        => 'btn btn-primary submit',
        'submit_button'       => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
    ));
    ?>
</div>

<?php
/**
 * Custom comment callback function
 */
function custom_blue_orange_comment($comment, $args, $depth)
{
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                    if ($args['avatar_size'] != 0) {
                        echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'comment-avatar'));
                    }
                    ?>
                    <b class="fn"><?php comment_author_link(); ?></b>
                    <span class="says">nói:</span>
                </div>

                <div class="comment-metadata">
                    <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            printf('%1$s at %2$s', get_comment_date('d/m/Y', $comment), get_comment_time());
                            ?>
                        </time>
                    </a>
                    <?php edit_comment_link('Chỉnh sửa', '<span class="edit-link">', '</span>'); ?>
                </div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation">Bình luận của bạn đang chờ duyệt.</em>
                <?php endif; ?>
            </footer>

            <div class="comment-content">
                <?php comment_text(); ?>
            </div>

            <div class="reply">
                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth'     => $depth,
                    'max_depth' => $args['max_depth'],
                    'before'    => '<div class="reply-link">',
                    'after'     => '</div>',
                )));
                ?>
            </div>
        </article>
    <?php
}
    ?>

    <style>
        /* Comments Styles */
        .comments-area {
            margin-top: 40px;
            padding: 30px;
            background-color: var(--white);
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .comments-title {
            color: var(--primary-blue);
            font-size: 1.2rem;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-orange);
        }

        .comment-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .comment-list .comment {
            margin-bottom: 25px;
            padding: 20px;
            background-color: var(--light-gray);
            border-radius: 4px;
            border-left: 4px solid var(--primary-orange);
        }

        .comment-list .children {
            margin-top: 20px;
            margin-left: 30px;
            list-style: none;
        }

        .comment-list .children .comment {
            background-color: var(--white);
            border-left: 4px solid var(--primary-blue);
        }

        .comment-body {
            position: relative;
        }

        .comment-meta {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .comment-author {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .comment-avatar {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .comment-author .fn {
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
        }

        .comment-author .fn:hover {
            color: var(--primary-orange);
        }

        .comment-author .says {
            color: var(--medium-gray);
            font-style: italic;
        }

        .comment-metadata {
            font-size: 0.7rem;
            color: var(--medium-gray);
        }

        .comment-metadata a {
            color: var(--medium-gray);
            text-decoration: none;
        }

        .comment-metadata a:hover {
            color: var(--primary-orange);
        }

        .comment-awaiting-moderation {
            color: var(--primary-orange);
            font-style: italic;
            display: block;
            margin-top: 10px;
        }

        .comment-content {
            margin: 15px 0;
            line-height: 1.6;
        }

        .comment-content p {
            margin-bottom: 10px;
        }

        .reply-link {
            margin-top: 10px;
        }

        .reply-link a {
            display: inline-block;
            padding: 5px 15px;
            background-color: var(--primary-blue);
            color: var(--white);
            text-decoration: none;
            border-radius: 3px;
            font-size: 0.7rem;
            transition: background-color 0.3s ease;
        }

        .reply-link a:hover {
            background-color: var(--primary-orange);
        }

        /* Comment Form Styles */
        .comment-respond {
            margin-top: 40px;
            padding: 25px;
            background-color: var(--light-gray);
            border-radius: 4px;
            border-left: 4px solid var(--primary-blue);
        }

        .comment-reply-title {
            color: var(--primary-blue);
            font-size: 20px;
            margin-bottom: 20px;
        }

        .comment-form p {
            margin-bottom: 15px;
        }

        .comment-form label {
            display: block;
            margin-bottom: 5px;
            color: var(--dark-gray);
            font-weight: 500;
        }

        .comment-form input[type="text"],
        .comment-form input[type="email"],
        .comment-form input[type="url"],
        .comment-form textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 0.8rem;
            transition: border-color 0.3s ease;
        }

        .comment-form input[type="text"]:focus,
        .comment-form input[type="email"]:focus,
        .comment-form input[type="url"]:focus,
        .comment-form textarea:focus {
            outline: none;
            border-color: var(--primary-blue);
            box-shadow: 0 0 5px rgba(44, 90, 160, 0.3);
        }

        .comment-form textarea {
            resize: vertical;
            min-height: 120px;
        }

        .comment-form .submit {
            background-color: var(--primary-orange);
            color: var(--white);
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .comment-form .submit:hover {
            background-color: var(--light-orange);
        }

        .no-comments {
            color: var(--medium-gray);
            font-style: italic;
            text-align: center;
            padding: 20px;
            background-color: var(--light-gray);
            border-radius: 5px;
        }

        /* Comments Pagination */
        .comment-navigation {
            margin: 30px 0;
            text-align: center;
        }

        .comment-navigation a {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary-blue);
            color: var(--white);
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
            transition: background-color 0.3s ease;
        }

        .comment-navigation a:hover {
            background-color: var(--primary-orange);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .comments-area {
                padding: 20px;
            }

            .comment-list .children {
                margin-left: 15px;
            }

            .comment-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .comment-respond {
                padding: 20px;
            }
        }
    </style>