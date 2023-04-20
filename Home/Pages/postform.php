<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>PostAD</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- style css -->
    <link rel="stylesheet" href="../css/postform.css">
</head>

<body class="main-layout">
    <header>
        <!-- header inner -->
        <div class="header">
            <div class="logo">
                <a href="">
                    <p class="Souk">Souk</p>
                    <p class="Auto">Auto</p>
                </a>
            </div>
        </div>
        <div class="Posting">
            <p class="PostingAd">Posting An AD....!</p>
        </div>
    </header>
    <div class="decor">
        <img src="../images/mazda.png" />
    </div>
    <div class="content">
        <form class="form" method="POST" action="..\utility\create_post.php" enctype="multipart/form-data">
            <legend class="formtitle">Post your AD!</legend>
            <label for="img" class="img">Upload Photos</label>
            <input type="file" class="img2" accept="image/*" name="picture" multiple required>
            <label for="name" class="name">Name:</label>
            <input type="text" class="name2" placeholder="Name of Your Car" name="name" id="name" required>
            <label for="year" class="year">Year:</label>
            <input type="number" id="year" min="1950" max="2023" class="year2" placeholder="Year of Your Car" name="year" required>
            <label for="price" class="price">Price:</label>
            <input type="number" class="price2" placeholder="Price of Your Car" name="price" id="price" required>
            <label for="region" class="region">Region:</label>
            <label for="description" class="desc">Description:</label>
            <input type="text" class="desc2" placeholder="description of Your Car" name="description" id="description" required>
            <label for="region" class="region">Region:</label>
            <select id="region" class="region2" name="region">
                <option value="">Select a wilaya</option>
                <option value="Adrar">Adrar</option>
                <option value="Chlef">Chlef</option>
                <option value="Laghouat">Laghouat</option>
                <option value="Oum El Bouaghi">Oum El Bouaghi</option>
                <option value="Batna">Batna</option>
                <option value="Béjaïa">Béjaïa</option>
                <option value="Biskra">Biskra</option>
                <option value="Béchar">Béchar</option>
                <option value="Blida">Blida</option>
                <option value="Bouira">Bouira</option>
                <option value="Tamanrasset">Tamanrasset</option>
                <option value="Tébessa">Tébessa</option>
                <option value="Tlemcen">Tlemcen</option>
                <option value="Tiaret">Tiaret</option>
                <option value="Tizi Ouzou">Tizi Ouzou</option>
                <option value="Algiers">Algiers</option>
                <option value="Djelfa">Djelfa</option>
                <option value="Jijel">Jijel</option>
                <option value="Sétif">Sétif</option>
                <option value="Saïda">Saïda</option>
                <option value="Skikda">Skikda</option>
                <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
                <option value="Annaba">Annaba</option>
                <option value="Guelma">Guelma</option>
                <option value="Constantine">Constantine</option>
                <option value="Médéa">Médéa</option>
                <option value="Mostaganem">Mostaganem</option>
                <option value="M'Sila">M'Sila</option>
                <option value="Mascara">Mascara</option>
                <option value="Ouargla">Ouargla</option>
                <option value="Oran">Oran</option>
                <option value="El Bayadh">El Bayadh</option>
                <option value="Illizi">Illizi</option>
                <option value="Bordj Bou Arreridj">Bordj Bou Arreridj</option>
                <option value="Boumerdès">Boumerdès</option>
                <option value="El Tarf">El Tarf</option>
                <option value="Tindouf">Tindouf</option>
                <option value="Tissemsilt">Tissemsilt</option>
                <option value="El Oued">El Oued</option>
                <option value="Khenchela">Khenchela</option>
                <option value="Souk Ahras">Souk Ahras</option>
                <option value="Tipaza">Tipaza</option>
                <option value="Mila">Mila</option>
                <option value="Aïn Defla">Aïn Defla</option>
                <option value="Naâma">Naâma</option>
                <option value="Aïn Témouchent">Aïn Témouchent</option>
                <option value="Ghardaïa">Ghardaïa</option>
                <option value="Relizane">Relizane</option>
            </select>

            <button type="submit" class="post">Post</button>

        </form>
    </div>
</body>