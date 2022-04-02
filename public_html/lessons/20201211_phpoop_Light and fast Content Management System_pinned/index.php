<?php
require '../../includes/header.php';
get_post_head('https://www.youtube.com/watch?v=Rh7mXaZl1oc');
$code_root_folder = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'projects' . DIRECTORY_SEPARATOR . 'php-playground' . DIRECTORY_SEPARATOR;

// START EDITING

p('<h4>A all in-one, lighweight and fast Content Management System to share posts with your visitors. Easily create and handle posts, authors and categories. The system includes an intuitive and clean user interface.</h4>'
,0,0);

    accordionin();
        accordionli('Features',<<<HTML
        <div class="paragraph">
            <ul>
                <li><b>Includes both frontent and admin interface.</b></li>
                <li><b>Categories, authors and posts can be removed, edited or created by admin.</b></li>
                <li>Authors can add a personal bio and a picture to their profile</li>
                <li><b>Posts are sortable</b> by categories on frontend.</li>
                <li>We can create as many categories as we want, and add a <b>short description</b> to them (displayd will sorting posts by categories.</li>
                <li><b>A complete "featured image" management system</b> allows to add thumnails to posts (displayed as cards on blog main's page).</li>
                <Li>The featured image is shown as a background image featuring the title on post pages. If no featured image uploaded, a default clean default layout is displayd. The exerpt length will automatically adapt too on blog's main page to maintain the layout's frame</li>
                <li><b>An image checker is included</b> (based on max. size, image type, duplicated content).</li>
                <li>The post edition <b>includes a Markdown system</b> to allow user to style their content. The markdown extension is made by MichelF (https://github.com/michelf/php-markdown) and added with Composer.</li>
                <li>I focused on creating a <b>smooth and nice to use UI</b></li>
                <li><b>Reusable Breadcrumb system</b> forboth frontend and admin panel</li>
                <li>Object oriented <b>code segmentation for mor modularity</b> and to allow further improvements more easily</li>
                <li>Works with a minimum of PHP files & <b>code as short as possible</b> (eg. Only one page is used for all post types listings: posts, categories, authors, same for common queries that are handle  with one file in which we inject various parameters)</li>
                <li>The database is handled with SQLite for its speed and lighweigth.</li>
                <li>A <b>more easily to handle and evolutive design</b>, based on Bootstrap framework (no CSSS to handle, or very few)</li>
                <li>Nice dashboard with a <b>daytime adapative greeting message</b></li>
                <li>Deletions are protected with <b>"confirmation" popups</b></li>
                <li>Queries errors are handled throught the Exceptions solution included in PHP </li>
                <li>The Admin area is <b>protected by a connexion system</b>, with <b>hashed username and password</b>.</li>
            </ul> 
        </div>
HTML);
        accordionout();

        p('<a href="#source-code">Go to source code</a>', 1, 0);

title('Frontend');

    exo_gallery_link(100, [8,9,10], '../blog/index.php', true, 0, 0);

title('Backend (Admin dashboard)');

    exo_gallery_link(100, [1,2,3,4,5,7], '../admin/blog/index.php', true, 0, 0);

anchor('source-code');
title('Source code');

    instruction('1. Frontend');

        p('blog/index.php');

        codein();
            $file = $code_root_folder . 'blog/index.php';
            echo htmlentities(file_get_contents($file));
        codeout();

        p('blog/post.php');

        codein();
            $file = $code_root_folder . 'blog/post.php';
            echo htmlentities(file_get_contents($file));
        codeout();

    instruction('2. Backend');

        p('admin/index.php');

        codein();
            $file = $code_root_folder . 'admin/index.php';
            echo htmlentities(file_get_contents($file));
        codeout();

        p('<h4>Post-types listings</h4>');

            p('admin/blog/index.php');

            codein();
                $file = $code_root_folder . 'admin/blog/index.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('admin/blog/index-cat-auth.php');

            codein();
                $file = $code_root_folder . 'admin/blog/index-cat-auth.php';
                echo htmlentities(file_get_contents($file));
            codeout();

        p('<h4>Editing pages</h4>');

            p('admin/blog/edit-post.php');

            codein();
                $file = $code_root_folder . 'admin/blog/edit-post.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('admin/blog/edit-category.php');

            codein();
                $file = $code_root_folder . 'admin/blog/edit-category.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('admin/blog/edit-author.php');

            codein();
                $file = $code_root_folder . 'admin/blog/edit-author.php';
                echo htmlentities(file_get_contents($file));
            codeout();

        p('<h4>Parts (forms)</h4>');

            p('admin/blog/parts/post-form.php');

            codein();
                $file = $code_root_folder . 'admin/blog/parts/post-form.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('admin/blog/parts/category-form.php');

            codein();
                $file = $code_root_folder . 'admin/blog/parts/category-form.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('admin/blog/parts/author-form.php');

            codein();
                $file = $code_root_folder . 'admin/blog/parts/author-form.php';
                echo htmlentities(file_get_contents($file));
            codeout();

        p('<h4>Parts (queries)</h4>');

            p('admin/blog/parts/edit-queries.php');

            codein();
                $file = $code_root_folder . 'admin/blog/parts/edit-queries.php';
                echo htmlentities(file_get_contents($file));
            codeout();

    instruction('3. Classes');

            p('class/BlogPDO.php');

            codein();
                $file = $code_root_folder . 'class/PDO/BlogPDO.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('class/PostTypeTable.php');

            codein();
                $file = $code_root_folder . 'class/Blog/PostTypeTable.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('class/Post.php');

            codein();
                $file = $code_root_folder . 'class/Post.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('class/BreadcrumbBlog.php');

            codein();
                $file = $code_root_folder . 'class/Blog/BreadcrumbBlog.php';
                echo htmlentities(file_get_contents($file));
            codeout();

            p('class/Modal.php');

            codein();
                $file = $code_root_folder . 'class/Modals/Modal.php';
                echo htmlentities(file_get_contents($file));
            codeout();

// STOP EDITING
        
require '../../includes/footer.php'; 

/**
 *  code for "<": &lt;
 */

?>