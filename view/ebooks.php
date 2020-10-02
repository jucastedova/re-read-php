<!DOCTYPE html>
<html lang="en">

<head>
  <title>CSS Website Layout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/styles.css">
  <script src="../js/code.js"></script>
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

      <!-- Nuevo desarrollo: Formulario para filtrar autor -->
      <div class="formulario">
        <form action="ebooks.php" method="POST">
          <label for="fautor">Nombre del autor:</label>
          <input type="text" id="fautor" name="fautor" placeholder="Introduce el autor...">
          
          <label for="cars">País:</label>
          <select name="pais" id="pais">
            <option value=""></option>
          </select>
        
          <input type="submit" value="Buscar">
        </form>
      </div>
      <!-- Lógica del formulario -->
      <?php
      // 1. Conexión a la BBDD
      include '../services/connection.php';
      if(isset($_POST['fautor'])) {
        // Filtrará los ebooks que se mostrarán en la página
        // 2. Selección y muestra de datos de la base de datos
        $query = "SELECT Books.Description, Books.img, 
        Books.Title FROM Books INNER JOIN BooksAuthors 
        ON Id=BooksAuthors.BookId INNER JOIN Authors ON
        Authors.Id = BooksAuthors.AuthorId
      WHERE Authors.Name LIKE '%{$_POST['fautor']}%'"; // 1, tiene ebook asociado
        $result = mysqli_query($conn, $query);
      } else {
        // Mostrará todos los ebooks de la BBDD
        // 2. Selección y muestra de datos de la base de datos
        $result = mysqli_query($conn, "SELECT books.Description, books.img, books.Title FROM books WHERE eBook !='0'"); // 1, tiene ebook asociado
      }
      // Se imprimen los libros según el resultado que haya almacenado en $result
      if (!empty($result) && mysqli_num_rows($result) > 0) {
        $i=0;
        // datos de salida de cada fila (fila = row)
        while($row = mysqli_fetch_array($result)) {
          $i++;
          echo "<div class='ebook'>";
          // Añadimos la imagen a la página con la etiqueta img de HTML
          echo "<img src=../img/".$row['img']." alt='".$row['Title']."'>";
          // Añadimos el título a la página con la etiqueta h2 de HTML
          echo "<div class='desc' id='desc".$i."'>".$row['Description']."</div>";
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



      <!-- eBooks con descripción -->
      <!-- <div class="ebook">
        <a href="https://books.google.es/books/about/El_drag%C3%B3n_rojo_Hannibal_Lecter_1.html?id=3QJhKj-fzycC&redir_esc=y">
          <img src="../img/dragon-rojo.jpg" alt="ebook 1">
          <div>Por el autor de El silencio de los corderos y...</div>
        </a>
      </div> -->
      <?php


      ?>

    </div>

    <div class="column right">
      <h2>Top Ventas</h2>
      <?php
        $result = mysqli_query($conn, "SELECT books.Title FROM books WHERE books.Top = '1'");
        if (!empty($result) && mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)) { 
            echo "<p>".$row['Title']."</p>";
          }
        } else {
          echo "No se han encontrado resultados";
        }
      ?>
    </div>
  </div>

</body>

</html>