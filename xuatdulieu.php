<?php
@include 'connec.php';
session_start();
if (!isset($_SESSION['username'])){
    header("Location: ./login.php ");
}
?>
<div class="t7">
        Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?>!
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIỂM TRA DỮ LIỆU</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
    #class {
        border-collapse: collapse;
        /* width: 100%; */
        height: 350px;
        width: 800px;
        position: absolute;
        top: 20%;
        left: 30%;
        background-color: white;
    }

    #class th, #class td {
        border: 2px solid black;
        text-align: left;
        padding: 8px;
    }

    #class tr:nth-child(even) {
        background-color: white;
    }
    .pagination {
        display: flex;
       justify-content: center;
        position: absolute;
        width: 100%;
        top: 90%;
        /* left: 50%;   */
    }
    .pagination1 {
        display: flex;
       justify-content: center;
        position: absolute;
        width: 100%;
        top: 90%;
        /* left: 50%;   */
    }

    .pagination a {
        text-decoration: none;
        color: blue;
        margin: 0 5px;
    }
    .pagination1 a {
        text-decoration: none;
        color: blue;
        margin: 0 5px;
    }
    .t1{
        position: absolute;
        top: 43%;
        left: 4%;
        border-radius: 5px;
    }
    .t2{
        position: absolute;
        top: 32%;
        left: 5%;
        font-size: 20px;
        color: red;
        border-radius: 10px;
    }
    .t3{
        position: absolute;
        top: 49%;
        left: 4%;
        height: 20px;
        width: 176px;
        background-color: darkgreen;
        color: #f2f2f2;
        border-radius: 5px;
    }
    .t5{
        position: absolute;
        border: 2px solid black;
        height: 200px;
        width: 250px;
        top: 30%;
        left: 2%;
        border-radius: 10px;
    }
    .t4{
        position: absolute;
        top: 54%;
        left: 4%;
        height: 20px;
        width: 176px;
        background-color: darkgreen;
        color: #dddddd;
        border-radius: 5px;
    }
    .img_2{
            position: absolute;
            top: -10px;
            left:-104px;
            /* height: 150px;
            width: 300px; */
            
        }
    .t7{
        text-align: center;
        position: relative;
        top: 7%; 
        font-size: 30px;
        color: red;
        
    }
    .t6{
        position: absolute;
        top: 58%;
        left: 4%;
        height: 20px;
        width: 176px;
        background-color: darkgreen;
        color: #dddddd;
        border-radius: 5px;
    }
    .dd{
        position: absolute;
        top: 70%;
        left: 4%;
        height: 20px;
        width: 176px;
        border-radius: 5px;
    }
    .dd1{
        position: absolute;
        top: 75%;
        left: 13%;
        height: 20px;
        width: 176px;
        border-radius: 5px;
    }
    .t8{
        position: absolute;
        top: 75%;
        left: 4%;
        height: 20px;
        width: 176px;
        border-radius: 5px;
    }
</style>
</head>
<body>
    <div>
        <img class="img_2"  src="image/logo1.png"  >
    </div>
    <div class="t5"></div>
    <h1 class="t2">BẢNG CÔNG CỤ</h1>
    <div id="output"></div>
    <input type="text" class="t1" placeholder="Search...">
    <button class="t3">sắp xếp tăng dần</button>
    <button class="t4" >sắp xếp giảm dần</button>
    <button class="t6" onclick="la_vang_roi()"> web dectech</button>
    <table id="class">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
    <div class="pagination"></div>
    <div class="pagination1"></div>
    <input type="text" class="dd" placeholder=" Ten nguoi diem danh" >
    <div class="dd1"></div>
    <div class="t8">Số lần điểm danh :</div>
    <script>
       
document.addEventListener("DOMContentLoaded", function() {
    var dataPerPage = 10; // Số lượng mục dữ liệu trên mỗi trang
    var currentPage = 1; // Trang hiện tại
    var responseData = [];
    var filteredData = [];
    $.ajax({
        type : "Get",
        url:"https://script.google.com/macros/s/AKfycbywfq5TTgZ3Eu2iQBNIw0dD8G5GGZNi_Da_eJ3elGroAfkBOBH0oFF3v3ZfuegNK7Ta/exec",
        dataType:"json",
        success: function(response){
            responseData = response;
            filteredData = response;
            var totalItems = response.length;
            var totalPages = Math.ceil(totalItems / dataPerPage);
            function displayData(page) {
                var start = (page - 1) * dataPerPage;
                var end = start + dataPerPage;
                var dataToShow = response.slice(start, end);
            // function appendData(data) {
                $("#class tbody").html("");
                // $("#class").append(firstRow);
                // data.forEach(function(item) {
                    dataToShow.forEach(function(item) {
                    var isoDate = new Date(item.Date);
                    var standardDate = isoDate.getDate() + "/" + (isoDate.getMonth() + 1) + "/" + isoDate.getFullYear();
                    var isotime = new Date(item.Time);
                    var standardTime = isotime.getHours()+":" + isotime.getMinutes()+":" +isotime.getSeconds();   
                    $("#class tbody").append("<tr><td>"+standardDate+ "</td><td>"+standardTime+"</td><td>"+item.Name+"</td></tr>");
                });
                displayPagination(page, totalPages);
            }
            
            function displayPagination(currentPage, totalPages) {
                $(".pagination").empty();
                var paginationHTML = "";
                for (var i = 1; i <= totalPages; i++) {
                    paginationHTML += "<a href='#' class='page-link' data-page='" + i + "'>" + i + "</a>";
                }
                 $(".pagination").html(paginationHTML);

                $(".page-link").click(function(e) {
                    e.preventDefault();
                    var page = $(this).attr("data-page");
                    displayData(page, responseData);
                });
            }
 
            displayData(currentPage, responseData);
            // appendData(response);
            // $(".t1").on("keyup", function() {
            //     var value = $(this).val().toLowerCase();
            //     $("#class tbody tr").each(function() {
            //         var rowText = $(this).text().toLowerCase();
            //         if (rowText.includes(value)) {
            //             $(this).css("display", ""); 
            //         } else {
            //             $(this).css("display", "none"); 
            //         }
            //     });
            // });
            $(".t1").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                var filteredData = responseData.filter(function(item) {
                    var rowText = (item.Date + " " + item.Time + " " + item.Name).toLowerCase();
                    return rowText.includes(value);
                });
                var totalFilteredItems = filteredData.length;
                var totalFilteredPages = Math.ceil(totalFilteredItems / dataPerPage);
                // $("#class tbody").empty();
                $(".pagination").empty();
                console.log(filteredData );
                // displayData1(1,filteredData);
                var totalItems1 = filteredData.length;
                var totalPages1 = Math.ceil(totalItems1 / dataPerPage);
                displayPagination1(currentPage, totalPages1, filteredData);
                displayData1(currentPage, filteredData, totalPages1);
                console.log(filteredData.length);
            });
            function displayData1(page1, filteredData, totalPages1) {
                var start1 = (page1 - 1) * dataPerPage;
                var end1 = start1 + dataPerPage;
                var dataToShow1 = filteredData.slice(start1, end1);
                $("#class tbody").empty();
                dataToShow1.forEach(function(item) {
                    var isoDate = new Date(item.Date);
                    var standardDate = isoDate.getDate() + "/" + (isoDate.getMonth() + 1) + "/" + isoDate.getFullYear();
                    var isotime = new Date(item.Time);
                    var standardTime = isotime.getHours() + ":" + isotime.getMinutes() + ":" + isotime.getSeconds();
                    $("#class tbody").append("<tr><td>" + standardDate + "</td><td>" + standardTime + "</td><td>" + item.Name + "</td></tr>");
                });
                displayPagination1(currentPage, totalPages1,filteredData); // Call the displayPagination1 function
            }

            // Define the displayPagination1 function outside of the keyup event
            function displayPagination1(currentPage, totalPages1,filteredData) {
                $(".pagination1").empty();
                var paginationHTML1 = "";
                for (var j = 1; j <= totalPages1; j++) {
                    paginationHTML1 += "<a href='#' class='page-link1' data-page1='" + j + "'>" + j + "</a>";
                }
                $(".pagination1").html(paginationHTML1);

                $(".page-link1").click(function(f) {
                    f.preventDefault();
                    var page1 = $(this).attr("data-page1");
                    displayData1(page1, filteredData,totalPages1);
                    currentPage = page1;
                });
            }
            
            
            $(".t3").on("click", function() {
                if(filteredData.length === 0){
                var sortedData = responseData.sort(function(a, b) {
                    return new Date(a.Date) - new Date(b.Date);
                    console.log("Sorted data:", sortedData);
                });
                // appendData(sortedData);
                displayData(currentPage);
                }else{
                    var sortedData = filteredData.sort(function(a, b) {
                        return new Date(a.Date) - new Date(b.Date);
                        console.log("Sorted data:", sortedData);
                    });
                    // appendData(sortedData);
                    displayData(currentPage,filteredData);
                }
                
            });
            $(".t4").on("click", function() {
                if(filteredData.length === 0){
                var sortedData = responseData.sort(function(a, b) {
                    return new Date(b.Date) - new Date(a.Date);
                    console.log("Sorted data:", sortedData);
                });
                // appendData(sortedData);
                
                displayData(currentPage);
                }else{
                    var sortedData = filteredData.sort(function(a, b) {
                        return new Date(a.Date) - new Date(b.Date);
                        console.log("Sorted data:", sortedData);
                    });
                    // appendData(sortedData);
                    displayData(currentPage,filteredData);
                }
                
            });
            
            
            
            
            $(".dd").on("keyup", function() {
                var value1 = $(this).val().toLowerCase();
                var filteredData1 = responseData.filter(function(item) {
                    if (item.Name && typeof item.Name === 'string'){
                    var rowText1 = (item.Name).toLowerCase();
                    return rowText1.includes(value1);
                    }
                    return false;
                });
                
                var total =filteredData1.length;
                var dd = chia_diem_danh(total);
                $(".dd1").text(dd);
                function chia_diem_danh(total){
                  var dd =  total / 2;
                  return Math.floor(dd);
                }
                console.log(chia_diem_danh(total));
                
            
        });
        }
    });
});
function la_vang_roi(){
    var url = "http://172.20.10.2";
    window.open(url, "_blank");
}
    </script>
</body>
</html>