window.addEventListener('DOMContentLoaded', function () {
    var selectBtn = document.querySelector('button[data-select-images="true"]');
    var newWindow; // Biến newWindow được khai báo ở mức độ phạm vi rộng

    window.addEventListener("message", (event) => {
        const receivedData = event.data;
        // console.log("Received data from child window:", receivedData);

        if (receivedData != null) {
            var imageNames = receivedData.map(function (image) {
                return image.name;
            });

            selectBtn.children[0].value = imageNames.join(", ");
            console.log(selectBtn.value);
        }
    });



    selectBtn.addEventListener('click', function (event) {
        event.preventDefault();
        openNewWindow();
    });

    function openNewWindow() {
        // var currentURL = window.location.href;
        var currentURL = window.location.href;

       
        // var currentURL = window.location.hostname + '/ct_shop/public/dashboard/media-module/';
        // var newURL = currentURL + "index.html";
        var newURL = '../../public/dashboard/media-module/' + "index.html";
        var windowFeatures = "width=1800,height=1000";

        newWindow = window.open(newURL, '_blank', windowFeatures); // Gán giá trị cho biến newWindow

        window.addEventListener('unload', function () {
            // Kiểm tra nếu newWindow không tồn tại, xóa dữ liệu trong localStorage
            if (!newWindow || newWindow.closed) {
                localStorage.removeItem('imageData');
            }
        });
    };
});