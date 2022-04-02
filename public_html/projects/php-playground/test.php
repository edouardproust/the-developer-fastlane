<?php
require_once 'class/Blog/BreadcrumbBlog.php';
require_once 'class/Post.php';

$brcb_blog = [
    'Blog' => BreadcrumbBlog::BLOG_ROOT,
    ucfirst($post->category) => BreadcrumbBlog::BLOG_ROOT . '?cat=' . Post::cat_name_format($post->category),
    ucfirst(htmlentities($post->title)) => null
];
$function = function ($step_title, $step_link) {
    return '<a href="' . $step_link . '">' . $step_title . '</a>';
};
var_dump(array_map($function, $brcb_blog));