
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
 
<url>
<loc><?php echo Router::url('/',true); ?></loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
 
<!-- Paginas estaticas -->
<url>
<loc><?php echo Router::url('/contacto',true); ?></loc>
<changefreq>yearly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc><?php echo Router::url('/nosotros',true); ?></loc>
<changefreq>yearly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc><?php echo Router::url('/canjea-tu-plan-ya',true); ?></loc>
<changefreq>yearly</changefreq>
<priority>0.8</priority>
</url>
<url>
<loc><?php echo Router::url('/vende-tu-plan-ya',true); ?></loc>
<changefreq>yearly</changefreq>
<priority>0.8</priority>
</url>
<url>
<loc><?php echo Router::url('/preguntas-frecuentes',true); ?></loc>
<changefreq>monthly</changefreq>
<priority>0.5</priority>
</url>
<url>
<loc><?php echo Router::url('/grandes-clientes',true); ?></loc>
<changefreq>yearly</changefreq>
<priority>0.7</priority>
</url>
<url>
<loc><?php echo Router::url('/plan-a-tu-medida',true); ?></loc>
<changefreq>yearly</changefreq>
<priority>0.7</priority>
</url>

<url>
<loc><?php echo Router::url('/planes/busqueda',true); ?></loc>
<changefreq>daily</changefreq>
<priority>0.8</priority>
</url>


<?php 
$marcas = array('','volkswagen','fiat','peugeot','citroen','ford','chevrolet','renault');
foreach ($marcas as $post):?>

<url>
<loc><?php echo Router::url('/planes-de-ahorro/nuevos/'.$post,true); ?></loc>
<changefreq>daily</changefreq>
<priority>0.9</priority>
</url>

<url>
<loc><?php echo Router::url('/planes-de-ahorro/adjudicados/'.$post,true); ?></loc>
<changefreq>daily</changefreq>
<priority>0.9</priority>
</url>

<url>
<loc><?php echo Router::url('/planes-de-ahorro/comenzados/'.$post,true); ?></loc>
<changefreq>daily</changefreq>
<priority>0.9</priority>
</url>

<?php endforeach; ?>




<!-- Planes -->
 
<?php foreach ($planes as $post):?>
<url>
<loc><?php echo Router::url('/plan-de-ahorro/'.$post["Plan"]["id"].'-'.$post["Plan"]["slug"],true);?></loc>
<lastmod><?php $phpdate = strtotime($post['Plan']['modified']);$date2 = date('Y-m-d',$phpdate);echo $date2;  ?></lastmod>
<changefreq>daily</changefreq>
<priority>0.9</priority>
</url>
 
<?php endforeach; ?>
 
 
 
</urlset>