<!DOCTYPE html>
<html lang="en">

<head>
  <title>CSS Website Layout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/styles.css">
</head>

<body>

  <div class="logo">Re-Read</div>
  <div class="header">
    <h1>Re-Read</h1>
    <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre
      hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de
      los dos.</p>
  </div>

  <div class="row">

    <div class="column left">
      <div class="topnav">
        <a href="../index.php">Re-Read</a>
        <a href="libros.php">Libros</a>
        <a href="./ebooks.php">eBooks</a>
      </div>
      <h3>Toda la actualidad en eBook</h3>

      <!-- eBooks con descripción -->
      <!-- <div class="ebook">
        <a href="https://books.google.es/books/about/El_drag%C3%B3n_rojo_Hannibal_Lecter_1.html?id=3QJhKj-fzycC&redir_esc=y">
          <img src="../img/dragon-rojo.jpg" alt="ebook 1">
          <div>Por el autor de El silencio de los corderos y...</div>
        </a>
      </div> -->
      <?php
        // 1. Conexión a la BBDD
        include '../services/connection.php';

        // 2. Selección y muestra de datos de la base de datos
        $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title FROM books WHERE eBook !='0'"); // 1, tiene ebook asociado
        if (!empty($result) && mysqli_num_rows($result) > 0) {
          $i=0;
          $counter = mysqli_num_rows($result);
          // datos de salida de cada fila (fila = row)
          while($row = mysqli_fetch_array($result)) {
            $i++;
            echo "<div class='ebook'>";
            // Añadimos la imagen a la página con la etiqueta img de HTML
            echo "<img src=../img/".$row['img']." alt='".$row['Title']."'>";
            // Añadimos el título a la página con la etiqueta h2 de HTML
            echo "<div>".$row['Title']."</div>";
            echo "</div>";
            if($i%3==0) {
              echo "<div style='clear:both;'></div>";
            }
          

            // https://github.com/dannylarrea/reread-php/tree/dev
            
          }
        } else {
          echo "0 resultados";
        }

      ?>

    </div>

    <div class="column right">
      <h2>Top Ventas</h2>
      <p>Cien años de soledad.</p>
      <p>Crónica de una muerte anunciada.</p>
      <p>El otoño del patriarca.</p>
      <p>El general en su laberinto.</p>
    </div>
  </div>

</body>

</html>