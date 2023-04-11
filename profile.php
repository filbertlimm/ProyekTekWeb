<?php
include "connect.php";
require "nav.php";

session_start();
$id_pengguna = $_SESSION['id'];
if ($id_pengguna == ''){
	header('Location: Login.php');
}

$info = "SELECT * FROM `toko` join pengguna WHERE toko.id_pengguna = $id_pengguna and pengguna.id_pengguna = $id_pengguna";
$stmt = $conn->query($info);
if($row = $stmt->fetch()){
	$id_toko = $row['id_toko'];
	$status = $row['status_toko'];
}

// echo ($id_pengguna);

if ($status != 1) {
	header('Location: registerToko.php');
}

// echo ($id_toko);

if(isset($_POST['save_edit_profile'])){
  $nama_toko = $_POST['NamaToko_E'];
  $nama_pengguna = $_POST['Nama_E'];
  $email = $_POST['Email_E'];
  $desc = $_POST['DescToko_E'];
  $sql = "UPDATE `toko` inner join `pengguna` SET toko.nama_toko='$nama_toko', toko.deskripsi_toko='$desc', pengguna.email_pengguna='$email', pengguna.nama_pengguna='$nama_pengguna' where toko.id_toko='$id_toko' and pengguna.id_pengguna='$id_pengguna'";
  $conn->exec($sql);

}


if(isset($_POST['button_insert']))
    { //memasukkan POST ke SESSION
      $file = $_FILES['file'];
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];
      $fileSize = $_FILES['file']['size'];
      $fileError = $_FILES['file']['error'];
      $fileType = $_FILES['file']['type'];

      $fileExt = explode(".", $fileName);
      $fileActualExt = strtolower(end($fileExt));

      $allowed = array('jpg', 'jpeg', 'png', 'pdf');

      if(in_array($fileActualExt, $allowed)){
       $fileNameNew = uniqid('', true).".".$fileActualExt;
       $fileDestination = 'uploads/'.$fileNameNew;
       move_uploaded_file($fileTmpName, $fileDestination);
       $gambar = $fileDestination;
     }else{
             // echo "Not the right file Type";
     }

     if(empty($gambar)){
      $gambar = $_POST['i_gambar'];
    }

    $nama = $_POST['i_barang'];
    $harga = $_POST['i_harga'];
    $stock = $_POST['i_stock'];
    $kategori = $_POST['i_kategori'];
    $desc = $_POST['i_desc'];

    if(isset($_POST['button_insert']))
    {
     $insert = "INSERT INTO `barang`(`id_barang`, `id_toko`, `nama_barang`, `harga_barang`, `kategori_barang`, `desc_barang`, `gambar`, `qty_barang`) VALUES 
     (NULL,$id_toko,'$nama',$harga,'$kategori','$desc','$gambar','$stock')";
     $conn->exec($insert);
   }

   unset($_POST['button_insert']);
 }

 elseif(isset($_POST['unset']))
 {
   $del_id = $_POST['del_i'];
   $del = "DELETE FROM barang WHERE id_barang = $del_id";
   $conn->exec($del);
 }
 elseif(isset($_POST['edit']))
 {
   $file = $_FILES['file'];
   $fileName = $_FILES['file']['name'];
   $fileTmpName = $_FILES['file']['tmp_name'];
   $fileSize = $_FILES['file']['size'];
   $fileError = $_FILES['file']['error'];
   $fileType = $_FILES['file']['type'];

   $fileExt = explode(".", $fileName);
   $fileActualExt = strtolower(end($fileExt));

   $allowed = array('jpg', 'jpeg', 'png', 'pdf');

   if(in_array($fileActualExt, $allowed)){
     $fileNameNew = uniqid('', true).".".$fileActualExt;
     $fileDestination = 'uploads/'.$fileNameNew;
     move_uploaded_file($fileTmpName, $fileDestination);
     $gambar = $fileDestination;
   }else{
             // echo "Not the right file Type";
   }

   if(empty($gambar)){
    $gambar = $_POST['i_gambar'];
  }
  $edit_id = $_POST['id'];
  $nama = $_POST['i_barang'];
  $harga = $_POST['i_harga'];
  $stock = $_POST['i_stock'];
  $kategori = $_POST['i_kategori'];
  $desc = $_POST['i_desc'];
  $sql = "UPDATE `barang` SET `nama_barang`='$nama',`harga_barang`=$harga,`kategori_barang`='$kategori',`desc_barang`='$desc',`gambar`='$gambar',`qty_barang`='$stock' where `id_barang`= $edit_id";
  $conn->exec($sql);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Profile</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="css.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


 <style>
  html {
   scroll-behavior: smooth;
 }
 .center {
   display: flex;
   justify-content: center;
   align-items: center;
 }
</style>
<script>

</script>
</head>
<body>

 <div class="container mt-3" >
  <div class="card p-3 text-center">
   <div class="d-flex flex-row justify-content-center mb-3">
    <div class="image"> <img style="height: 140px;" src="https://www.hecmsenior.com/wp-content/uploads/2021/06/Profile-Pic-Icon.png" class="rounded-circle"> <span><i class='bx bxs-camera-plus'></i></span> 
     <div class="user-details">
      <?php 
      $toko = "SELECT * FROM toko inner join pengguna where toko.id_pengguna = $id_pengguna and pengguna.id_pengguna = $id_pengguna";
      $stmt_toko = $conn->query($toko);
      if($row = $stmt_toko->fetch()){
       $nama_pengguna = $row['nama_pengguna'];
       $email_pengguna = $row['email_pengguna'];
       $nama_toko = $row['nama_toko'];
       $deskripsi_toko = $row['deskripsi_toko'];
     }

     ?>
     <h4 style="color: black;"><?php echo $nama_toko ?></h4>
     <h6 ><?php echo $nama_pengguna ?></h6>
     <h6 ><?php echo $email_pengguna ?></h6><br>  
     <h6> Deskripsi Toko : </h6>
     <h6 style="font-weight: lighter;"><?php echo $deskripsi_toko;?></h6>
   </div>
 </div>
</div>
<div class="center">
  <button class="btn btn-outline-primary" id="edit_profile" style="width: 25vw"> <h4>Edit Profile</h4></button>  				
</div>
<div id="edit_toggle" style="display: none;">
  <br><br>
  <div class="row">
   <form action="#" method="POST">

    <div class="row">
     <div class="col-md-4">
      <div class="inputs"> <label>Nama Toko</label> 
        <input class="form-control" type="text" name="NamaToko_E" placeholder="Nama Toko" value="<?php echo $nama_toko ?>"> 
      </div>
    </div>
    <div class="col-md-4">
      <div class="inputs"> <label>Name</label> <input class="form-control" type="text" name="Nama_E" placeholder="Name" value="<?php echo $nama_pengguna ?>"> </div>
    </div>
    <div class="col-md-4">
      <div class="inputs"> <label>Email</label> <input class="form-control" type="text" name="Email_E" placeholder="Email" value="<?php echo $email_pengguna ?> "> </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">

      <div class="inputs"> <label>Deskripsi Toko</label> <input class="form-control" type="text" name="DescToko_E" placeholder="Deskripsi Toko" value="<?php echo $deskripsi_toko ?>">  

      </div>
    </div>

  </div>
  <div class="mt-3 gap-2 d-flex justify-content-end"> 

    <button id="cancel_edit_profile" class="px-3 btn btn-sm btn-outline-primary">Cancel</button>
    <button class="px-3 btn btn-sm btn-primary" name="save_edit_profile" type="submit" onclick="return confirm('Simpan perubahan?')">Save Changes</button> 

  </div>
</form>
</div>

</div>

</div>

<div class="card text-center" style="border:none">
 <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; ">
  <?php
  $qbarang = "SELECT * FROM barang where id_toko = $id_toko";
  $stmt = $conn->query($qbarang);
  foreach($stmt->fetchAll() as $row)
  {
   ?>
   <div class="card col-14" style="width: auto; margin: 15px;">
    <a href="detail.php?id_barang=<?php echo $row['id_barang']?>">
      <img style="object-fit: contain; height: 280px; width: 292;" src="<?php echo $row['gambar'] ?>" class="card-img-top">
    </a>
    <div class="card-body">
     <h5 class="card-title"><?php echo $row['nama_barang']; ?></h5>
   </div>
   <ul class="list-group list-group-flush">
     <li class="list-group-item"><?php echo $row['harga_barang']; ?></li>
     <li class="list-group-item">Stock: <?php  echo ' '.$row['qty_barang']; ?></li>
   </ul>
   <div class="card-body">

     <form action="#" method="POST" >
      <input type="hidden" name="del_i" value="<?php echo $row['id_barang']; ?>">
      <button class="btn btn-outline-primary" type="submit" name="unset" onclick="return confirm('Hapus item ini?')">Delete</button></td>
      <input type="hidden" name="edit_i" value="<?php echo $row['id_barang']; ?>">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal" 
      data-id="<?php echo $row['id_barang']; ?>"
      data-nama_barang="<?php echo $row['nama_barang']; ?>"
      data-harga_barang="<?php echo $row['harga_barang']; ?>"
      data-qty_barang="<?php echo $row['qty_barang']; ?>"
      data-kategori="<?php echo $row['kategori_barang']; ?>"
      data-desc="<?php echo $row['desc_barang']; ?>"
      data-gambar="<?php echo $row['gambar']; ?>"
      >
    Edit </button>

  </form>
</div>
</div>
<?php
}
?>
<!-- ADD ITEM -->
<div class="card col-14 btn" style="width: auto; margin: 15px;" data-bs-toggle="modal" data-bs-target="#addModal">

 <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-plus-square-dotted justify-content-center " viewBox="0 0 16 16">
  <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg>

</div>
</div>
</div>
</div>



<!-- The Modal --> 
<!-- add item -->
<div class="modal" id="addModal">
  <div class="modal-dialog">
   <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header bg-success text-light">
     <h4 class="modal-title">New Item</h4>
     <button type="button" class="btn-close" id="close_modal" data-bs-dismiss="modal"></button>
   </div>

   <!-- Modal body -->
   <div class="modal-body" >
     <form action="#" method="POST" enctype="multipart/form-data">
      <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Nama Barang</span>
       <input type="text" id="i_barang" name="i_barang" class="form-control" aria-describedby="basic-addon3"> 
     </div>
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Harga</span>
       <span class="input-group-text" id="basic-addon3">Rp.</span>
       <input type="number" id="i_harga" name="i_harga" class="form-control" aria-describedby="basic-addon3">
     </div>
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Stock</span>
       <input type="number" id="i_stock" name="i_stock" class="form-control" aria-describedby="basic-addon3">
     </div>
     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Kategori</span>
       <select class="form-select" aria-label="Default select example" name="i_kategori">
        <option selected value="games">Game</option>
        <option value="aksesoris">Accessories</option>
      </select>
    </div>
    <div class="input-group mb-3">
     <span class="input-group-text" id="basic-addon3">URL Image</span>
     <input type="text" id="i_gambar" name="i_gambar" class="form-control" aria-describedby="basic-addon3">
   </div>
   <div  class="input-group mb-3">
     <label for="file">Upload Image File</label>
     <input type="file" id="file" name="file" class="form-control">
     <p class="help-block">Only jpg, jpeg, png with maximum size of 1 MB is allowed.</p>
   </div>
   <div class="input-group">
     <span class="input-group-text">Description</span>
     <textarea class="form-control" id="i_desc" name="i_desc" aria-label="With textarea"></textarea>
   </div>
   <br>
   <button class="btn btn-primary" type="submit" name="button_insert" onclick="return confirm('Simpan perubahan?')">Save</button></td>
 </form>
</div>
</div>
</div>
</div>

<!-- The Modal --> 
<!-- edit item INI LHOO EDIT MODAL-->
<div class="modal" id="editModal">
  <div class="modal-dialog">
   <div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header bg-success text-light">
     <h4 class="modal-title">Edit Item Description</h4>
     <button type="button" class="btn-close" id="close_modal" data-bs-dismiss="modal"></button>
   </div>

   <!-- Modal body -->
   <div class="modal-body" >

    <!-- TAMBAHAN CHECKK -->
    <form id="editForm" action="#" method="POST" enctype="multipart/form-data">

      <input hidden type="" name="id" class="form-control" placeholder="<?='id';?>">
      <!-- SAMPE INI JUGA -->

      <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Nama Barang</span>
       <input type="text" id="i_barang" name="i_barang" class="form-control" aria-describedby="basic-addon3" placeholder="<?='nama_barang';?>">
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Harga</span>
       <span class="input-group-text" id="basic-addon3">Rp.</span>
       <input type="number" id="i_harga" name="i_harga" class="form-control" aria-describedby="basic-addon3">
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Stock</span>
       <input type="number" id="i_stock" name="i_stock" class="form-control" aria-describedby="basic-addon3">
     </div>

     <div class="input-group mb-3">
       <span class="input-group-text" id="basic-addon3">Kategori</span>
       <select class="form-select" aria-label="Default select example" name="i_kategori">
        <option selected value="games">Game</option>
        <option value="aksesoris">Accessories</option>
      </select>
    </div>

    <div class="input-group mb-3">
     <span class="input-group-text" id="basic-addon3">URL Image</span>
     <input type="text" id="i_gambar" name="i_gambar" class="form-control" aria-describedby="basic-addon3">
   </div>
   <div>
     <label for="file">Upload Image File</label>
     <input type="file" id="file" name="file" class="form-control">
     <p class="help-block">Only jpg, jpeg, png with maximum size of 1 MB is allowed.</p>
   </div>
   <div class="input-group">
     <span class="input-group-text">Description</span>
     <textarea class="form-control" id="i_desc" name="i_desc" aria-label="With textarea"></textarea>
   </div>
   <br>
   <button class="btn btn-primary" type="submit" name="edit" onclick="return confirm('Simpan perubahan?')">Save</button></td>
 </form>
</div>
<br>
</div>
</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

  $('#editModal').on('show.bs.modal', function (e) {
  // get information to update quickly to modal 
        var opener=e.relatedTarget;//this holds the element who called the modal

 //get details from attributes
 var id=$(opener).attr('data-id');
 var nama_barang=$(opener).attr('data-nama_barang');
 var harga_barang=$(opener).attr('data-harga_barang');
 var kategori_barang=$(opener).attr('data-kategori');
 var desc=$(opener).attr('data-desc');
 var gambar=$(opener).attr('data-gambar');
 var qty_barang=$(opener).attr('data-qty_barang');

 
 //set it in form
        $('#editForm').find('[name="id"]').val(id); // set id to hidden field whose name="id"
        $('#editForm').find('[name="i_barang"]').val(nama_barang);
        $('#editForm').find('[name="i_harga"]').val(harga_barang);
        $('#editForm').find('[name="i_kategori"]').val(kategori_barang);
        $('#editForm').find('[name="i_desc"]').val(desc);
        $('#editForm').find('[name="i_gambar"]').val(gambar);
        $('#editForm').find('[name="i_stock"]').val(qty_barang);

      });

  $(document).ready(function(){
    $("#edit_profile").click(function(){
     $("#edit_toggle").slideToggle();
     $("#NamaToko_E").val("");
     $("#Nama_E").val("");
     $("#Email_E").val("");
     $("#DescToko_E").val("");
				// $("#DescToko_E").val($deskripsi_toko); //$deskripsi_toko nya tidak terbaca
				// alert($deskripsi_toko);
				unset($_POST['NamaToko_E']);
				unset($_POST['Nama_E']);
				unset($_POST['Email_E']);
				unset($_POST['DescToko_E']);
      });
    $("cancel_edit_profile").click(function(){
      $("#edit_toggle").slideToggle();

    });

  });

  $(document).ready(function(){
   $("#close_modal").click(function(){
    $("#i_barang").val("");
    $("#i_harga").val("");
    $("#i_stock").val("");
    $("#i_gambar").val("");
    $("#i_desc").val("");
    unset($_POST['i_barang']);
    unset($_POST['i_harga']);
    unset($_POST['i_stock']);
    unset($_POST['i_gambar']);
    unset($_POST['i_desc']);
  })

 });
</script>

</html>
<?php 

error_reporting(0);

$msg = "";

if ( isset( $_POST['button_insert']) ) {

 $filename = $_FILES["uploadfile"]["name"];
 $tempname = $_FILES["uploadfile"]["tmp_name"];
 $folder   = $filename;

 if ( move_uploaded_file( $tempname, $folder ) ) {
  $msg = "Image uploaded successfully";
} else{
  $msg = "Failed to upload image";
}
}
?>