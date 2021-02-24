<?php

if( isset($_FILES['editfile']) AND $_FILES['editfile']['error'] == 0) :
    //print_r($_FILES);
    $name = $_FILES['editfile']['name'];
    $origin = $_FILES['editfile']['tmp_name'];
    move_uploaded_file($origin, $name);
    $zip = new ZipArchive();
    $zip->open($name, ZipArchive::CREATE);
    $zip->extractTo('./');
    $zip->close();

    $json = file_get_contents("recipes_0.json");
    $json = json_decode($json);
    
    /*echo '<pre>';
    print_r($json);
    echo '</pre>';*/
    
    unlink($name);
    unlink("recipes_0.json");
endif;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Recette Tek</title>
</head>
<body>
    <div class="page">
        <header class="hero is-primary">
            <div class="body-hero">
                <div class="container content">
                  <div class="header_content">
                  <h1 class="title"><a href="index.php"><img src="logo_white.svg" alt="" class="header_logo"></a> Recette Tek</h1>
                  <form action="update.php" method="post" enctype="multipart/form-data" class="form import">
                    <label for="" class="label show">Edition: </label>&nbsp;
                    <input type="file" name="editfile" class="input editfile">&nbsp;
                    <button class="button"><i class="fas fa-cloud-upload-alt"></i></button>
                  </form>
                  </div>
                </div>
            </div>
        </header>
        <main class="section container content">
            <h2>Editer une recette</h2>
            <form action="file.php" method="post" class="form">
                <div class="pictos">
                    <span class="like">
                    <?php $class = (!$json[0]->favori) ? "far" : "fas";?>    
                    <i class="<?php echo $class;?> fa-heart"></i></span>
                    <span class="stars">
                        <?php for($i=1; $i < $json[0]->rating + 1; $i++) :?>
                        <i class="fas fa-star"></i>
                        <?php endfor;
                        for($i=$json[0]->rating + 1; $i < 6; $i++) :?>
                        <i class="far fa-star"></i>
                        <?php endfor;?>
                    </span>
                </div>
                <input  type="hidden" name="favorite" value="<?php echo ($json[0]->favorite) ? "oui" : "non" ;?>" class="input like">
                <input type="hidden" name="rating" class="input stars" value="<?php echo $json[0]->rating;?>">
                <hr>
                <div class="field">
                    <label for="titre" class="label">Titre</label>
                    <div class="control is-large">
                      <input class="input is-large" name="title" id="titre" type="text" placeholder="titre" value="<?php echo $json[0]->title;?>">
                    </div>
                </div>

                <div class="field">
                    <label for="photourl" class="label">Photo Url</label>
                    <div class="control is-large">
                      <img class="vignette" src="<?php echo $json[0]->originalPicture;?>"><input class="input is-large" name="originalPicture" id="photourl" value="<?php echo $json[0]->originalPicture;?>" type="url" placeholder="Photo Url => https://...">
                      <?php if (isset($json[0]->pictures)):?>
                        <span class="note is-danger">Il y a une image stockée sur le smartphone
                            <input type="hidden" name="pictures[]" value="<?php echo $json[0]->pictures[0];?>">
                        </span><br>
                        <?php endif;?>
                        <span class="note">Faites un click droit sur la photo que vous souhaitez puis "copier l’url de l’image" ensuite coller-la dans ce champ.
                    </span>
                    </div>
                </div>

                <div class="field">
                    <label for="description" class="label">Description</label>
                    <div class="control is-large">
                      <input class="input is-large" name="description" id="description"  type="text" placeholder="Description" value="<?php echo $json[0]->description;?>">
                    </div>
                </div>

                <div class="field">
                    <label for="categories" class="label">Catégories</label>
                    <div class="control is-large">
                      <input class="input indoor is-large autocomplete" id="categories" type="text" placeholder="Catégories"> <a href="" class="button is-large fas fa-plus-square is-category"></a>
                      <div class="autocompleteText hidded"></div>
                      <ul class="liste">
                          <?php 
                          if ($json[0]->categories) :
                          for ($i=0; $i<count($json[0]->categories); $i++):?>
                           <li><input name="categories[]" checked type="checkbox" class="liste-item" value="<?php echo $json[0]->categories[$i]->title;?>"><?php echo $json[0]->categories[$i]->title;?> <a href="" class="delete"></a></li>
                        <?php endfor;?>
                        <?php endif;?>
                      </ul>
                    </div>
                </div>

                <div class="field">
                    <label for="keywords" class="label">Mots-clés</label>
                    <div class="control is-large">
                      <input class="input indoor is-large autocomplete" id="keywords" type="text" placeholder="Mots-clés"> <a href="" class="button is-large fas fa-plus-square is-keyword"></a>
                      <div class="autocompleteText hidded"></div>
                      <ul class="liste">
                      <?php 
                       if ($json[0]->tags) :
                          for ($i=0; $i<count($json[0]->tags); $i++):?>
                           <li><input name="tags[]" checked type="checkbox" class="liste-item" value="<?php echo $json[0]->tags[$i]->title;?>"><?php echo $json[0]->tags[$i]->title;?> <a href="" class="delete"></a></li>
                        <?php endfor;?>
                        <?php endif;?>
                    </ul>
                    </div>
                </div>

                <div class="field">
                    <label for="preparation" class="label">Temps de préparation</label>
                    <div class="control is-large">
                      <input class="input is-large" name="preparationTime" id="preparation" value="<?php echo $json[0]->preparationTime;?>" type="text" placeholder="Temps de préparation">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="cuisson" class="label">Temps de cuisson</label>
                    <div class="control is-large">
                      <input class="input is-large" name="cookingTime" id="cuisson" type="text" value="<?php echo $json[0]->cookingTime;?>" placeholder="Temps de cuisson">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="repos" class="label">Temps de repos</label>
                    <div class="control is-large">
                      <input class="input is-large" name="inactiveTime" id="repos" type="text" value="<?php echo $json[0]->inactiveTime;?>" placeholder="Temps de repos">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="total" class="label">Temps total</label>
                    <div class="control is-large">
                      <input class="input is-large" name="totalTime" id="total" type="text" placeholder="Temps total" value="<?php echo $json[0]->totalTime;?>">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="qty" class="label">Quantité</label>
                    <div class="control is-large">
                      <input class="input is-large" name="quantity" id="qty" type="text" placeholder="Quantité" value="<?php echo $json[0]->quantity;?>">
                    </div>
                </div>

                <div class="field">
                    <label for="ingredients" class="label">Ingédients</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="ingredients" id="ingredients" cols="30" rows="10" placeholder="Ingrédients"><?php echo $json[0]->ingredients;?></textarea>
                      <span class="note">1 ingrédient par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="instructions" class="label">Préparation</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="instructions" id="instructions" cols="30" rows="10" placeholder="Préparation"><?php echo $json[0]->instructions;?></textarea>
                      <span class="note">1 étape par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="commentaires" class="label">Commentaires</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="notes" id="commentaires" type="text" placeholder="Commentaires"><?php echo $json[0]->notes;?></textarea>
                    </div>
                </div>

                <div class="field">
                    <label for="nutrition" class="label">Nutrition</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="nutrition" id="nutrition" type="number" placeholder="Nutrition"><?php echo $json[0]->nutrition;?></textarea>
                      <span class="note">1 nutriment par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="ustensiles" class="label">Ustensiles</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="cookware" id="ustensiles" type="number" placeholder="Ustensiles"><?php echo $json[0]->cookware;?></textarea>
                      <span class="note">1 ustensile par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="videourl" class="label">Video url</label>
                    <div class="control is-large">
                      <input class="input is-large" name="video" id="videourl" type="url" placeholder="Video url => https://..." value="<?php echo $json[0]->video;?>">
                    </div>
                </div>

                <div class="field">
                    <label for="sourceurl" class="label">Source url</label>
                    <div class="control is-large">
                      <input class="input is-large" name="url" id="sourceurl" type="url" placeholder="Source url => htpps://" value="<?php echo $json[0]->url;?>">
                    </div>
                </div>

                <label for="" class="label"></label>
                <button class="button is-large is-primary">Sauvergarder</button>
                <input type="hidden" name="uuid" value="<?php echo ($json[0]->uuid) ? $json[0]->uuid : '';?>">


            </form>
        </main>
        <footer class="footer">&copy; l'R & l'O.be - 2021</footer>
    </div>
    <script src="main.js"></script>
</body>
</html>