<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/class/Bergerie.js"></script>
    <script src="js/class/Mouton.js"></script>
    <script src="js/main.js"></script>
    <title>Bergerie</title>
</head>

<body id="bergerie">


    <form id="howMany">
        <label for="howManyField">Combien de moutons dans le pré ?</label>
        <select name="howManyField" id="howManyField">
            <?php for ($i = 1; $i < 300; $i++) : ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <input type="submit" value="Ok">
    </form>

</body>

</html>