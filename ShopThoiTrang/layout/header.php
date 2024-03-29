
<!DOCTYPE html>
<html>
<head>
    <title>Camper Store</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../script/jsNguoiDung/jquery-1.11.0.min.js"></script>
    <!-- Custom Theme files -->
    <link href="../css/cssNguoiDung/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../script/jsNguoiDung/bootstrap.min.js"></script>
    <!--theme-style-->
    <link href="../css/cssNguoiDung/style.css" rel="stylesheet" type="text/css" media="all" />
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Free Style Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!--fonts-->
    <link href='//fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,400,500,700,800,900,100italic,300italic,400italic,500italic,700italic,800italic,900italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
    <!--//fonts-->
    <script type="text/javascript" src="../script/jsNguoiDung/move-top.js"></script>
    <script type="text/javascript" src="../script/jsNguoiDung/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- camper store -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz"
        crossorigin="anonymous">
    <link href="../css/style123.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="../css/shop.css" type="text/css" media="screen" property="" />
    <link href="../css/style7.css" rel="stylesheet" type="text/css" media="all" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/login.css" rel="stylesheet" type="text/css" media="all" />
    <!-- start menu -->
    <script src="../script/jsNguoiDung/simpleCart.min.js"> </script>
    <link href="../css/cssNguoiDung/memenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="../script/jsNguoiDung/memenu.js"></script>
    <script>$(document).ready(function(){$(".memenu").memenu();});</script>

    <?php
    session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "shopthoitrang";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
    mysqli_query($conn,"set names utf8");

    function phan_trang($tenCot,$tenBang,$dieuKien,$soLuongSP,$trang,$dieuKienTrang)
    {
		global $conn;
        $spbatdau=$trang*$soLuongSP;

        $laySP=" SELECT ".$tenCot." FROM ".$tenBang." ".$dieuKien ." LIMIT ".$spbatdau.",".$soLuongSP;
        $truyvanLaySP=mysqli_query($conn,$laySP);

        $tongsoluongsp=mysqli_num_rows(mysqli_query($conn," SELECT ".$tenCot." FROM ".$tenBang." ".$dieuKien));
        $tongsotrang=$tongsoluongsp/$soLuongSP;

        $dsTrang="";
        for($i = 0 ; $i < $tongsotrang; $i++)
        {
            $sotrang=$i+1;
            $dsTrang .=  "<a class='divtrang_".$i."' href='".$_SERVER["PHP_SELF"]."?trang=".$i.$dieuKienTrang."'>". $sotrang  . "</a> ";
        }

        echo "<script>
                $(document).ready(function(){
                    $('.divtrang').html(\"".$dsTrang."\")
                });
            </script>";

        return $truyvanLaySP;
    }

    if(isset($_GET["dx"]))
        unset($_SESSION["tendangnhap"]);

    if(isset($_GET["moiGH"]))
        unset($_SESSION["giohang"]);

    function DinhDangTien($dongia) //1000000
    {
        $sResult = $dongia;
        for ( $i = 3; $i < strlen($sResult); $i += 4)
        {
            $sSau = substr($sResult,strlen($sResult) - $i); // 000.000
            $sDau = substr($sResult,0, strlen($sResult) - $i); // 1
            $sResult = $sDau . "." . $sSau; // 1.000.000
        }
        return $sResult;
    }

    ?>
</head>
<body>
<?php include_once "../include/header.php";?>
<!--top-header-->
<div class="top-header">
    <div class="container">
        <div class="top-header-main">
            <div class="col-md-4 top-header-left">
                <div class="search-bar">
                    <form method="post" action="TimKiemSanPham.php">
                        <input name="tkTenSP" type="text" placeholder="Nhập tên sản phẩm...">
                        <input type="submit" value="">
                        <button class="btn btn-success">Tìm kiếm</button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 top-header-middle">
                <!-- <a href="index.php" ><img src="../images/logo1.jpg" alt="" /></a> -->
            </div>
            <div class="col-md-4 top-header-right divgiohang">

                <?php
                if(isset($_SESSION["giohang"]))
                {
                    $tongsp=0;
                    $tongtien=0;
                    foreach($_SESSION["giohang"] as $cotGH)
                    {
                        $tongsp++;
                        $tongtien+=$cotGH["dongia"]*$cotGH["soluong"];
                    }
                    ?>
                    <div class="cart box_1">
                        <a href="GioHang.php">
                            <h3> <div class="total">
                                    <span > <?php echo DinhDangTien($tongtien); ?> VNĐ </span> (<span id="simpleCart_quantity" > <?php echo $tongsp; ?> </span> SP)</div>
                                <img src="../images/cart-1.png" alt="" />
                        </a>
                        <p><a href="SanPham.php?moiGH=0" class="simpleCart_empty">Làm mới</a></p>
                        <div class="clearfix"> </div>
                    </div>
                <?php
                }
                else{
                    ?>
                    <div class="cart box_1">
                        <a href="GioHang.php">
                            <h3> <div class="total">
                                    <span > 0 VNĐ </span> (<span id="simpleCart_quantity" > 0 </span> sản phẩm)</div>
                                <img src="../images/cart-1.png" alt="" />
                        </a>
                        <p><a href="SanPham.php?moiGH=0"  class="simpleCart_empty">Làm mới</a></p>
                        <div class="clearfix"> </div>
                    </div>
                <?php } ?>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--top-header-->
<!--bottom-header-->
<div class="header-bottom">
    <div class="container">
        <div class="top-nav">
            <ul class="memenu skyblue"><li class="active"><a href="index.php">Trang chủ</a></li>
                <li ><a href="about.php">Giới thiệu</a></li>
                <li class="grid"><a>Sản phẩm</a>
                    <div class="mepanel">
                        <div class="row">
                            <div class="col1 me-one">
                                <ul>
                                    <?php
                                        global $conn;
                                        $layLoaiSP="SELECT * FROM loaisp";
                                        $truyvan_layLoaiSP=mysqli_query($conn,$layLoaiSP);
                                        while($cot=mysqli_fetch_array($truyvan_layLoaiSP))
                                        {
                                            ?>
                                            <li><a href="DanhMucSanPham.php?loaisp=<?php echo $cot["MaLoaiSP"] ?>"><?php echo $cot["TenLoai"] ?></a></li>
                                        <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <?php if(!isset($_SESSION["tendangnhap"])) { ?>

                    <li ><a href="DangKy.php">Đăng ký</a></li>
                    <li ><a href="#" data-toggle="modal" data-target=".bs-example-modal-lg">Đăng nhập</a></li>

                <?php }else{ ?>
                    <li ><a href="ThongTinTaiKhoan.php"><span style="text-transform:none">Xin chào <?php echo $_SESSION["tendangnhap"]; ?></span></a> <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?dx=0"> Đăng xuất</a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="padding: 50px">
                <form method="post" action="DangNhap.php">
                    <input type="hidden" name="tranghientai" value="<?php echo $_SERVER["PHP_SELF"]; ?>">
                    <div class="account-top heading">
                        <h3>Đăng nhập</h3>
                        <p>Nếu bạn đã có tài khoản, đăng nhập tại đây</p>
                    </div>
                    <div class="address">
                        <span>Tên đăng đăng nhập</span>
                        <input id="dn_tendangnhap" name="tendangnhap" type="text">
                    </div>
                    <div class="address">
                        <span>Mật khẩu</span>
                        <input id="dn_matkhau" name="matkhau" type="password">
                    </div>
                    <div class="address">
                        <span style="color: red;" id="dn_thongbao"></span>
                        <a class="forgot" href="../page/QuenMatKhau.php">Quên mật khẩu?</a>
                        <input id="dangnhap" type="submit" value="Đăng nhập">
                    </div>
                    <br>
                    <div class="login_main">
                        <div class="login_main_bottom">
                            <span>Bạn chưa có tài khoản?</span>
                            <a href="DangKy.php">Đăng ký</a>
                        </div>
                    </div>
                    <div class="login_col">
                        <div class="login_main">
                            <div class="login_main_fire">
                                <a id="login_via_fb" href="#" class="login_fire">
                                    <i class='fab fa-facebook-square' style='font-size:36px'></i>   
                                    <span>Facebook</span>
                                </a>
                                <a id="login_via_gg" href="#" class="login_fire">
                                    <i class='fab fa-google' style='font-size:36px'></i>
                                    <span>Google</span>
                                </a>
                            </div>
                        </div>
                    </div>
            </form>
            <script>
                $(document).ready(function(){
                    $('#dangnhap').click(function(){
                        dn_tendangnhap=$('#dn_tendangnhap').val();
                        dn_matkhau=$('#dn_matkhau').val();

                        loi=0;
                        if(dn_tendangnhap=="" || dn_matkhau=="")
                        {
                            loi++;
                            $('#dn_thongbao').text("Hãy nhập đầy đủ thông tin");
                        }

                        if(loi!=0)
                        {
                            return false;
                        }
                    });
                });
            </script>
        </div>
    </div>
</div>
<!--bottom-header-->
