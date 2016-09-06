<?php
@session_start();
include "../+koneksi.php";

if(@$_POST['simpan']) {

$sumber = @$_FILES['gambar']['tmp_name'];
$target = '../uploads/essay_attachment/';
$nama_gambar = @$_FILES['gambar']['name'];

$id_tq = mysqli_real_escape_string($db, $_POST['id_tq']);

$soal = mysqli_query($db, "SELECT * FROM tb_soal_pilgan where id_tq = '$id_tq'") or die ($db->error);
$pilganda = mysqli_num_rows($soal);

$soal_esay = mysqli_query($db, "SELECT * FROM tb_soal_essay WHERE id_tq = '$id_tq'") or die ($db->error);
$esay = mysqli_num_rows($soal_esay);

if (!empty($pilganda) AND !empty($esay)) {

  if(!empty($_POST['soal_pilgan'])) {
      $benar = 0;
      $salah = 0;
      foreach($_POST['soal_pilgan'] as $key => $value){
        $cek = mysqli_query($db, "SELECT * FROM tb_soal_pilgan WHERE id_pilgan = '$key'") or die ($db->error);
        while($c = mysqli_fetch_array($cek)){
            $jawaban = $c['kunci'];
        }
        if($value == $jawaban) {
            $benar++;
        } else {
            $salah++;
        }
    }
    $jumlah = $_POST['jumlahsoalpilgan'];
    $tidakjawab = $jumlah - $benar - $salah;
    $persen = $benar / $jumlah;
    $hasil = $persen * 100;
    mysqli_query($db, "INSERT INTO tb_nilai_pilgan VALUES (NULL, '$id_tq', '$_SESSION[siswa]', '$benar', '$salah', '$tidakjawab', '$hasil')") or die ($db->error);
  } else if(empty($_POST['soal_pilganda'])){
      $jumlah = $_POST['jumlahsoalpilgan'];
      mysqli_query($db, "INSERT INTO tb_nilai_pilgan VALUES (NULL, '$id_tq', '$_SESSION[siswa]', '0', '0', '$jumlah', '0')") or die ($db->error);
  }

  if(!empty($_POST['soal_essay'])) {
      foreach($_POST['soal_essay'] as $key2 => $value) {
        $jawaban = $value;
        $cek = mysqli_query($db, "SELECT * FROM tb_soal_essay WHERE id_essay = '$key2'");
        while($data = mysqli_fetch_array($cek)) {
          if($nama_gambar[$key2] == '') {
            mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','$jawaban','')") 
            or die ($db->error);
          } else {
            if(move_uploaded_file($sumber[$key2], $target.$nama_gambar[$key2])) {
              mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','$jawaban','$nama_gambar[$key2]')") 
              or die ($db->error);          
            } else {
              echo '<script>alert("Lampiran gagal diupload, coba lagi!");</script>';
            }
          }
        }
      }
  } else if (empty($_POST['soal_esay'])){
      if($nama_gambar[$key2] == '') {
        mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','','')") 
        or die ($db->error);
      } else {
        if(move_uploaded_file($sumber[$key2], $target.$nama_gambar[$key2])) {
          mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','','$nama_gambar[$key2]')") 
          or die ($db->error);          
        } else {
          echo '<script>alert("Lampiran gagal diupload, coba lagi!");</script>';
        }
      }
  }
  echo "<script>window.location='./../?page=quiz&action=infokerjakan&id_tq=".$id_tq."';</script>";
}

///////////

if (empty($pilganda) AND !empty($esay)) {
  if(!empty($_POST['soal_essay'])) {
    foreach($_POST['soal_essay'] as $key2 => $value){
      $jawaban = $value;
      $cek = mysqli_query($db, "SELECT * FROM tb_soal_essay WHERE id_essay = '$key2'");
      while($data = mysqli_fetch_array($cek)) {
        if($nama_gambar[$key2] == '') {
          mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','$jawaban','')") 
          or die ($db->error);
        } else {
          if(move_uploaded_file($sumber[$key2], $target.$nama_gambar[$key2])) {
            mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','$jawaban','$nama_gambar[$key2]')") 
            or die ($db->error);          
          } else {
            echo '<script>alert("Lampiran gagal diupload, coba lagi!");</script>';
          }
        }
      }
    }
  } else if(empty($_POST['soal_essay'])) {
    if($nama_gambar[$key2] == '') {
      mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','','')") 
      or die ($db->error);
    } else {
      if(move_uploaded_file($sumber[$key2], $target.$nama_gambar[$key2])) {
        mysqli_query($db, "INSERT INTO tb_jawaban VALUES(NULL, '$id_tq','$data[id_essay]','$_SESSION[siswa]','','$nama_gambar[$key2]')") 
        or die ($db->error);          
      } else {
        echo '<script>alert("Lampiran gagal diupload, coba lagi!");</script>';
      }
    }
  }
  echo "<script>window.location='./../?page=quiz&action=infokerjakan&id_tq=".$id_tq."';</script>";
}

if (!empty($pilganda) AND empty($esay)) {
  if(!empty($_POST['soal_pilgan'])) {
      $benar = 0;
      $salah = 0;
      foreach($_POST['soal_pilgan'] as $key => $value) {
          $cek = mysqli_query($db, "SELECT * FROM tb_soal_pilgan WHERE id_pilgan = '$key'") or die ($db->error);
          while($c = mysqli_fetch_array($cek)) {
              $jawaban = $c['kunci'];
          }
          if($value == $jawaban) {
              $benar++;
          } else {
              $salah++;
          }
      }
      $jumlah = $_POST['jumlahsoalpilgan'];
      $tidakjawab = $jumlah - $benar - $salah;
      $persen = $benar / $jumlah;
      $hasil = $persen * 100;
      mysqli_query($db, "INSERT INTO tb_nilai_pilgan VALUES(NULL, '$id_tq', '$_SESSION[siswa]', '$benar', '$salah', '$tidakjawab', '$hasil')") or die ($db->error);

  } else if(empty($_POST['soal_pilgan'])) {
      $jumlah = $_POST['jumlahsoalpilgan'];
      mysqli_query($db, "INSERT INTO tb_nilai_pilgan VALUES(NULL, '$id_tq', '$_SESSION[siswa]', '0', '0', '$jumlah', '0')") or die ($db->error);
  }
  echo "<script>window.location='./../?page=quiz&action=infokerjakan&id_tq=".$id_tq."';</script>";
} 

}
?>