<!-- src/views/register_view.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Inscription</h1>
    <form action="register.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom" required><br>

        <label for="telephone">Téléphone:</label>
        <input type="text" id="telephone" name="telephone" required><br>

        <label for="code_p">Code Postal:</label>
        <input type="text" id="code_p" name="code_p" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="ville">Ville:</label>
        <input type="text" id="ville" name="ville" required><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
