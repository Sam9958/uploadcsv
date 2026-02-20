<div class="container">
    <h2>Upload user CSV</h2>
    <input type="file" name="csv_file" id="csv_file">
    <button type="submit" id="csv_submit">Submit</button>
    <div class="result">
    </div>
</div>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script>
    $(document).ready(function () {
        $("#csv_submit").on("click", function () {
            const file = $("#csv_file")[0].files[0];
            let formdata = new FormData();
            formdata.append("csv_file", file);
            $.ajax({
                url: "api/upload_csv",
                method: "POST",
                data: formdata,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    $(".result").html(response);
                }
            });
        });
    })
</script>