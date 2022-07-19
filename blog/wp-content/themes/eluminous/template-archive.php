<?php

/*

Template Name: Archives

*/



get_header(); ?>

<div id="primary" class="content-area col-sm-12 col-md-8">
  <main id="main" class="site-main" role="main">
    <article id="post-1336" class="post-1336 page type-page status-publish ">
      <article class="col-sm-12 col-md-6" >
        <h2>Archives by Month:</h2>
        <ul>
          <?php wp_get_archives('type=monthly'); ?>
        </ul>
      </article>
      <article class="col-sm-12 col-md-6" >
        <h2>Archives by Subject:</h2>
        <ul>
          <?php wp_list_categories(); ?>
        </ul>
      </article>
    </article>
  </main>
  
  <!-- #main --> 
  
</div>

<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
