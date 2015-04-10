<div class="sharing">
    <form method="post"  action="Post/doAdd.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Title">
        </div>


        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <select class="type" name="type">
                <option value="Tips">Tips/Tricks</option>
                <option value="Tips">Tricks</option>
                <optgroup label="how-top">
                    <option>Videos</option>
                    <option>article</option>
                </optgroup>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Images</label>
            <input type="file" name='image' id="exampleInputFile">

        </div>


        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <textarea class="form-control" name="body"></textarea>

        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>