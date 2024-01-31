<style>
    td div a:hover i {
        font-size: 20px;
        transition: .3s ease-out;
    }
</style>
<div id="main-content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Danh sách Danh mục</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo ROOT_URL . 'dashboard' ?>"><i class="fa fa-dashboard"></i></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Danh mục</li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="d-flex flex-row-reverse">
                        <div class="page_action">
                            <a href="#addModal" data-toggle="modal" data-target="#addModal">
                                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    Thêm</button>
                            </a>
                        </div>
                        <div class="p-2 d-flex">

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2>Danh sách</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th style="width:60px;">#</th>
                                        <th>Tên Danh Mục</th>
                                        <th class="text-center">Icon</th>
                                        <th class="col-2 text-center">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($dataBrands)) {
                                        $dataArr = json_decode($dataBrands, true);
                                        foreach ($dataArr as $key => $item) {
                                    ?>

                                            <tr>
                                                <td>
                                                    <?= $key + 1 ?>
                                                </td>
                                                <td>
                                                    <?= $item['name'] ?>
                                                </td>

                                                <td> <?= $item['alias'] ?></td>
                                                <td>
                                                    <div class="d-flex justify-content-around">
                                                        <a id="viewModalBtn" href="#viewModal" data-toggle="modal" data-target="#viewModal" value="<?= $item['id'] ?>" title="Xem">
                                                            <i class="fa fa-search"></i>
                                                        </a>

                                                        <a id="editModalBtn" href="#editModal" data-toggle="modal" data-target="#editModal" value="<?= $item['id'] ?>" title="Sửa">
                                                            <i class="fa fa-edit text-secondary"></i>
                                                        </a>

                                                        <a href="" title="Xóa" data-itemid="<?= $item['id'] ?>" onclick="deleteItem(event)">
                                                            <i class="fa fa-trash-o text-danger"></i>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>

                                    <?php
                                            // print_r($data);
                                        }
                                    } else
                                        echo 'Danh sách rỗng';

                                    ?>


                                </tbody>
                            </table>

                            <div class="col-12 pt-4 btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <style>
                                    .paginationBtn:link,
                                    .paginationBtn:visited {
                                        text-transform: uppercase;
                                        text-decoration: none;
                                        color: #59C4BC;
                                        font-weight: 700;
                                        padding: 10px 15px;
                                        margin: 0 1px;
                                        border: 1px solid #59C4BC;
                                        border-radius: 1000px;
                                        display: inline-block;
                                        transition: all .2s;
                                        position: relative;
                                    }

                                    .paginationBtn:hover {
                                        transform: translateY(-5px);
                                        background-color: #59C4BC;
                                        color: white;
                                    }

                                    .paginationBtn:active {
                                        transform: translateY(-3px);
                                    }

                                    .paginationBtn::after {
                                        content: "";
                                        display: inline-block;
                                        height: 100%;
                                        width: 100%;
                                        border-radius: 100px;
                                        top: 0;
                                        left: 0;
                                        position: absolute;
                                        z-index: -1;
                                        transition: all .3s;
                                    }

                                    .paginationBtn:hover::after {
                                        background-color: #59C4BC;
                                        /* transform: scaleX(1.4) scaleY(1.5); */
                                        opacity: 0;
                                    }
                                </style>
                                <div class="col-12 btn-group d-flex justify-content-center m-auto" role="group"
                                    aria-label="First group">
                                    <?php
                                    for ($i = 1; $i <= $listPage; $i++) { ?>
                                        <a class="paginationBtn"
                                            href="http://localhost/ct_shop/dashboard/brands/list?page=<?php echo $i ?>">
                                            <?php echo $i ?>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>













        <script>
            let data = <?php echo $dataBrands; ?>;
            // console.log(data);

            document.addEventListener('DOMContentLoaded', function() {
                let viewModal = document.getElementById('viewModal');
                let viewModalLabel = document.getElementById('viewModalLabel');
                let viewModalBody = viewModal.querySelector('.modal-body');

                let viewModalBtns = document.querySelectorAll("#viewModalBtn");

                viewModalBtns.forEach(function(viewBtn) {
                    viewBtn.addEventListener('click', function(event) {
                        let viewTargetValue = viewBtn.getAttribute('value');
                        let viewFilteredData = data.filter(function(item) {
                            return item.id === parseInt(viewTargetValue);

                        });

                        if (viewFilteredData.length > 0) {
                            let item = viewFilteredData[0];
                            viewModalLabel.textContent = item.name;
                            viewModalBody.innerHTML = `
                        <div class="card">
                            <div class="body">
                                <ul class="list-unstyled basic-list">
                                    <li>ID <span class="badge">${item.id}</span></li>
                                    <li>Tên Danh Mục <span class="badge">${item.name}</span></li>
                                    <li>Alias<span class="badge">${item.alias}</span></li>
                                    <li>Keyword<span class="badge text-wrap text-justify pb-4">${item.keyword}</span></li>
                                    <li>Description<span class="badge text-wrap text-justify pb-4">${item.description}</span></li>
                                    <li>Trạng thái<span class="badge">${item.hidden == 0 ? "Ẩn" : "Hiện"}</span></li>
                                    <li>Ngày tạo<span class="badge">${item.created_at}</span></li>
                                    <li>Ngày cập nhật<span class="badge">${item.updated_at}</span></li>
                                </ul>
                            </div>
                        </div>
                    `;
                        }

                        // Show the modal
                        // You can use your preferred method to show the modal, for example:
                        // viewModal.show();
                    });
                });




                let editModal = document.getElementById('editModal');
                let editModalLabel = document.getElementById('editModalLabel');
                let editModalBody = editModal.querySelector('.modal-body');

                let editModalBtns = document.querySelectorAll("#editModalBtn");
                editModalBtns.forEach(function(editBtn) {
                    editBtn.addEventListener('click', function(event) {
                        let editTargetValue = editBtn.getAttribute('value');
                        let editFilteredData = data.filter(function(item) {
                            return item.id === parseInt(editTargetValue);
                        });

                        if (editFilteredData.length > 0) {
                            let item = editFilteredData[0];
                            editModalLabel.textContent = "Cập nhật";
                            editModalBody.innerHTML = `
                            <div class="modal-body">
                                <div class="row clearfix">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="body">
                                                    <form id="basic-form" action="" method="POST" enctype="multipart/form-data" novalidate>
                                                        <input type="hidden" class="form-control" name="id" value="${item.id}">
                                                        <div class="form-group">
                                                            <label>Tên Danh Mục</label>
                                                            <input type="text" class="form-control" name="name" value="${item.name}" required>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 px-0">
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2>Icon <small> Danh Mục</small>
                                                                    </h2>
                                                                </div>
                                                                <div class="body">
                                                                    <input type="file" class="dropify">
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <!-- <div class="header">
                                                                    <h2>With event and default file <small>try to remove the
                                                                            image</small></h2>
                                                                </div> -->
                                                                <div class="body">
                                                                    <input type="file" id="dropify-event"
                                                                        data-default-file="assets/images/auth_bg.jpg">
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="header">
                                                                    <h2>Disabled file upload</h2>
                                                                </div>
                                                                <div class="body">
                                                                    <input type="file" class="dropify" disabled="disabled">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Keyword</label>
                                                            <input type="email" class="form-control" name="keyword" value="${item.keyword}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="5" cols="30" name="description"
                                                                required>${item.description}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Trạng thái</label>
                                                            <br />
                                                            <label class="fancy-radio">
                                                                <input type="radio" name="hidden" ${item.hidden == 0 ? "checked" : ""} value="0" required
                                                                    data-parsley-errors-container="#error-radio">
                                                                <span><i></i>Ẩn</span>
                                                            </label>
                                                            <label class="fancy-radio">
                                                                <input type="radio" name="hidden" ${item.hidden == 1 ? "checked" : ""} value="1">
                                                                <span><i></i>Hiện</span>
                                                            </label>
                                                            <p id="error-radio"></p>
                                                        </div>

                                                        <!-- <br> -->
                                                        <div class="modal-footer">
                                                            <input type="submit" class="btn btn-primary" name="update" value="Lưu thay đổi"></input>
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Hủy</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }

                        // Show the modal
                        // You can use your preferred method to show the modal, for example:
                        // viewModal.show();
                    });
                });
            });



            function deleteItem(event) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ a

                var itemId = event.currentTarget.getAttribute('data-itemid'); // Lấy giá trị của thuộc tính data-itemid

                console.log(itemId); // In ra giá trị itemId trong console

                // Tạo biểu mẫu và thêm các trường cần thiết
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = ''; // Thay YOUR_FORM_ACTION_URL bằng URL xử lý biểu mẫu

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete';
                input.value = itemId;

                // Thêm các trường vào biểu mẫu và gửi biểu mẫu
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        </script>








        <!-- Default Size -->
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="viewModalLabel"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="card">

                            <div class="body">
                                <ul class=" list-unstyled basic-list">
                                    <li>ID <span class="badge">21</span></li>
                                    <li>Tên Danh Mục <span class="badge">Hossein</span></li>
                                    <li>Alias<span class="badge">Hossein</span></li>
                                    <li>Keyword<span class="badge text-wrap text-justify pb-4">Hos seinH osse inHos
                                            seinHosse inHosseinHo sseinHossein HosseinHosse inHosseinHosse
                                            inHosseinHosseinHosseinHossein</span></li>
                                    <li>Description<span class="badge text-wrap text-justify pb-4">Hos seinH osse inHos
                                            seinHosse inHosseinHo sseinHossein HosseinHosse inHosseinHosse
                                            inHosseinHosseinHosseinHossein</span></li>
                                    <li>Trạng thái<span class="badge">Hossein</span></li>
                                    <li>Ngày tạo<span class="badge">Hossein</span></li>
                                    <li>Ngày cập nhật<span class="badge">Hossein</span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- LargeSize -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="addModalLabel">Tạo Danh Mục</h4>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="body">
                                            <form id="basic-form" action="" method="POST" enctype="multipart/form-data" novalidate>
                                                <div class="form-group">
                                                    <label>Tên Danh Mục</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label>Icon</label>
                                                    <div class="reviewImage text-center"></div>
                                                    <input type="file" class="form-control" name="image"
                                                        onchange="handleImageUpload(event)" />
                                                </div> -->
                                                <!-- <script>
                                                    function handleImageUpload(event) {
                                                        var file = event.target.files[0]; // Get the first selected file

                                                        // Create a FileReader object
                                                        var reader = new FileReader();

                                                        // Set up the onload event handler
                                                        reader.onload = function (e) {
                                                            var imageSrc = e.target.result; // Get the base64-encoded image URL

                                                            // Create the <img> element and set its source
                                                            var imgElement = document.createElement('img');
                                                            imgElement.src = imageSrc;
                                                            imgElement.classList.add('py-2'); // Add the 'py-2' class to the imgElement

                                                            // Create the remove button
                                                            var removeButton = document.createElement('button');
                                                            removeButton.textContent = 'Remove Image';
                                                            removeButton.addEventListener('click', function () {
                                                                imgElement.remove(); // Remove the imgElement when the button is clicked
                                                                removeButton.remove(); // Remove the button itself
                                                                clearFileInput(); // Reset the input file field
                                                            });

                                                            // Clear the reviewImage div and append the <img> element and remove button
                                                            var reviewImageDiv = document.querySelector('.reviewImage');
                                                            reviewImageDiv.innerHTML = '';
                                                            reviewImageDiv.appendChild(imgElement);
                                                            reviewImageDiv.appendChild(removeButton);
                                                        };

                                                        // Read the selected file as a data URL
                                                        reader.readAsDataURL(file);
                                                    }

                                                    function clearFileInput() {
                                                        var fileInput = document.querySelector('input[type="file"]');
                                                        fileInput.value = ''; // Reset the value of the file input field
                                                    
                                                    }
                                                </script> -->

                                                <div class="form-group">
                                                    <label>Keyword</label>
                                                    <input type="text" class="form-control" name="keyword" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5" cols="30" name="description" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Trạng thái</label>
                                                    <br />
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="hidden" value="0" required data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Ẩn</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="hidden" value="1">
                                                        <span><i></i>Hiện</span>
                                                    </label>
                                                    <p id="error-radio"></p>
                                                </div>

                                                <!-- <br> -->
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-primary" name="create" value="Tạo danh mục"></input>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- LargeSize -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="editModalLabel">Cập nhật</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row clearfix">
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="body">
                                            <form id="basic-form" action="#" method="POST" enctype="multipart/form-data" novalidate>
                                                <div class="form-group">
                                                    <label>Tên Danh Mục</label>
                                                    <input type="text" class="form-control" placeholder="${item.name}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Keyword</label>
                                                    <input type="text" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" rows="5" cols="30" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Trạng thái</label>
                                                    <br />
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="gender" value="male" required data-parsley-errors-container="#error-radio">
                                                        <span><i></i>Ẩn</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input type="radio" name="gender" value="female">
                                                        <span><i></i>Hiện</span>
                                                    </label>
                                                    <p id="error-radio"></p>
                                                </div>

                                                <!-- <br> -->
                                                <div class="modal-footer">

                                                    <input type="submit" class="btn btn-primary" value="Lưu thay đổi"></input>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Hủy</button>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>