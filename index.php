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
                    <input type="file" class="input newfile">&nbsp;
                    <button class="button"><i class="fas fa-cloud-upload-alt"></i></button>
                  </form>
                  </div>
                </div>
            </div>
        </header>
        <main class="section container content">
            <h2>Nouvelle recette</h2>
            <form action="file.php" method="post" class="form">
                <div class="pictos">
                    <span class="like"><i class="far fa-heart"></i></span> <span class="stars"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></span>
                </div>
                <input type="hidden" name="favorite" value="oui" class="input like">
                <input type="hidden" name="rating" class="input stars" value="0">
                <hr>
                <div class="field">
                    <label for="titre" class="label">Titre</label>
                    <div class="control is-large">
                      <input class="input is-large" name="title" id="titre" type="text" placeholder="titre">
                    </div>
                </div>

                <div class="field">
                    <label for="photourl" class="label">Photo Url</label>
                    <div class="control is-large">
                      <input class="input is-large" name="originalPicture" id="photourl" type="url" placeholder="Photo Url => https://...">
                      <span class="note">Faites un click droit sur la photo que vous souhaitez puis "copier l’url de l’image" ensuite coller-la dans ce champ.
                    </span>
                    </div>
                </div>

                <div class="field">
                    <label for="description" class="label">Description</label>
                    <div class="control is-large">
                      <input class="input is-large" name="description" id="description"  type="text" placeholder="Description">
                    </div>
                </div>

                <div class="field">
                    <label for="categories" class="label">Catégories</label>
                    <div class="control is-large">
                      <input class="input indoor is-large" id="categories" type="text" placeholder="Catégories"> <a href="" class="button is-large fas fa-plus-square is-category"></a>
                      <ul class="liste">
                      </ul>
                    </div>
                </div>

                <div class="field">
                    <label for="keywords" class="label">Mots-clés</label>
                    <div class="control is-large">
                      <input class="input indoor is-large" id="keywords" type="text" placeholder="Mots-clés"> <a href="" class="button is-large fas fa-plus-square is-keyword"></a>
                      <ul class="liste">
                        
                    </ul>
                    </div>
                </div>

                <div class="field">
                    <label for="preparation" class="label">Temps de préparation</label>
                    <div class="control is-large">
                      <input class="input is-large" name="preparationTime" id="preparation" value="0" type="number" placeholder="Temps de préparation">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="cuisson" class="label">Temps de cuisson</label>
                    <div class="control is-large">
                      <input class="input is-large" name="cookingTime" id="cuisson" type="number" value="0" placeholder="Temps de cuisson">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="repos" class="label">Temps de repos</label>
                    <div class="control is-large">
                      <input class="input is-large" name="inactiveTime" id="repos" type="number" value="0" placeholder="Temps de repos">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="total" class="label">Temps total</label>
                    <div class="control is-large">
                      <input class="input is-large" name="totalTime" id="total" type="number" placeholder="Temps total">
                    </div>
                    <span class="note">En minutes.
                    </span>
                </div>

                <div class="field">
                    <label for="qty" class="label">Quantité</label>
                    <div class="control is-large">
                      <input class="input is-large" name="quantity" id="qty" type="number" placeholder="Quantité">
                    </div>
                </div>

                <div class="field">
                    <label for="ingredients" class="label">Ingédients</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="ingredients" id="ingredients" cols="30" rows="10" placeholder="Ingrédients"></textarea>
                      <span class="note">1 ingrédient par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="instructions" class="label">Préparation</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="instructions" id="instructions" cols="30" rows="10" placeholder="Préparation"></textarea>
                      <span class="note">1 étape par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="commentaires" class="label">Commentaires</label>
                    <div class="control is-large">
                      <input class="input is-large" name="notes" id="commentaires" type="text" placeholder="Commentaires">
                    </div>
                </div>

                <div class="field">
                    <label for="nutrition" class="label">Nutrition</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="nutrition" id="nutrition" type="number" placeholder="Nutrition"></textarea>
                      <span class="note">1 nutriment par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="ustensiles" class="label">Ustensiles</label>
                    <div class="control is-large">
                      <textarea class="textarea is-large" name="cookware" id="ustensiles" type="number" placeholder="Ustensiles"></textarea>
                      <span class="note">1 ustensile par ligne</span>
                    </div>
                </div>

                <div class="field">
                    <label for="videourl" class="label">Video url</label>
                    <div class="control is-large">
                      <input class="input is-large" name="video" id="videourl" type="url" placeholder="Video url => https://...">
                    </div>
                </div>

                <div class="field">
                    <label for="sourceurl" class="label">Source url</label>
                    <div class="control is-large">
                      <input class="input is-large" name="url" id="sourceurl" type="url" placeholder="Source url => htpps://">
                    </div>
                </div>

                <label for="" class="label"></label>
                <button class="button is-large is-primary">Sauvergarder</button>



            </form>
        </main>
        <footer class="footer">&copy; l'R & l'O.be - 2021</footer>
    </div>
    <script src="FileSaver.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.6.0/jszip.min.js"></script>
    <script src="main.js"></script>
</body>
</html>