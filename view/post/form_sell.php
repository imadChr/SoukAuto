<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Your AD</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="assets/css/postform.css">

</head>

<body>
    <div class="d-flex justify-content my-3">
        <button type="button" class="btn btn-outline-primary toggle-filter-btn">
            <ion-icon name="funnel-outline"></ion-icon>
        </button>
    </div>
    <h5 class="form-title">Post your car for sale!</h5>
    <form method="POST" action="index.php?action=addPost" enctype="multipart/form-data">
        <section class="form1">
            <div>
                <label for="brand">Brand:</label>
                <select id="brand" name="brand_id" required>
                    <option value="">Select a brand</option>
                    <?php
                    // Output each brand as an option in the select input
                    foreach ($brands as $row) {
                        echo '<option value="' . $row['brand_id'] . '">' . $row['brand'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="model">Model:</label>
                <select id="select_model" name="model_id" required>
                    <option value="" disabled>Select a brand first</option>
                </select>
            </div>
            <div>
                <label for="wilaya">Wilaya:</label>
                <select id="wilaya" name="wilaya">
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
            </div>
            <div>
                <label for="fuel">Fuel Type:</label>
                <select name="fuel" id="fuel">
                    <option value="">Select fuel type</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Essence">Essence</option>
                    <option value="GPL">GPL</option>
                    <option value="Hybrid">Hybrid</option>
                    <option value="Electrique">Electrique</option>
                </select>
            </div>
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" placeholder="Enter title" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <input type="text" name="description" placeholder="Enter description" required>
            </div>
            <div>
                <label for="year">Year:</label>
                <input type="number" id="year" min="1950" max="2023" placeholder="Year of Your Car" name="year" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" name="price" placeholder="Enter price">
            </div>
            <div>
                <label for="mileage">Mileage:</label>
                <input type="number" name="mileage" placeholder="Mileage" required>
            </div>
            <div>
                <label for="picture">Upload pictures:</label>
                <input type="file" name="pictures[]" id="picture" accept="image/*" multiple required>
            </div>
        </section>
    </form>
    <section>
        <button type="submit" class="btn">Submit</button>
    </section>