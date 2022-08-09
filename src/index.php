
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-color: #FDFDFD;
    }
    .double{
        /* text-align: left; */
    }
    .fa-solid:hover{
        cursor: pointer;
        color:red;
        transform: scale(1.5);
    }
    form{
        display:flex;
        gap:2vw;
    }
    #res .table{
        width:80vw;
    }
    #res .table tr:nth-child(2n-2){
        background-color:#F5F5F5;
    }
    #res .table .t{
        width:40vw;
    }
    #res .table .r{
        width:18vw;
    }
    #res .table  button{
        background-color:#C73835;
        color:white;
        border:none;
        padding:0.5vw 3vw 0.5vw 3vw;
        border-radius:5px;
    }
    .btn{
        margin-top:-3vw;
        border:none;
        padding:1vw 3vw 1vw 3vw;
        border-radius:5px;
    }
    input{
        width:30vw;
    }

</style>
<body>
    <h1>My Favourite Movies</h1>
    <form onsubmit="add_movie(event)"action="#" method="post">
        <p>
            Title:<input type="text" name='title' placeholder="Movie Title" required>
        </p>
        <p>
            Rating:<input type="number" name='rating' required min="0" max="10" placeholder="Rate movie from 0 to 10">
        </p>
        <p>
            <button class='btn' type="submit">Add Movie</button>
        </p>
    </form>
    <div id='res'>
        
        
    </div>

</body>

<script>
    const add_movie = (e)=>{
        e.preventDefault();
        $title = e.target.title.value;
        $rate = e.target.rating.value;
        
        $.ajax({
            type: "POST",
            url:'Server.php',
            data: {
                title : $title,
                rating : $rate
            },
            success: (response)=>{
                // debugger;
                let data = JSON.parse(response);
                show_results(data);

            }
        });
    }

    const delete_movie = (item , event)=>{
        event.target.parentElement.parentElement.remove();
        $.ajax({
            type: "POST",
            url:'Server.php',
            data: {
                delete_movie:item,
            },
            success: (response)=>{
                let data = JSON.parse(response);    
                show_results(data);
            }
        });
    }

    const sortAsec = (cat)=>{
        $.ajax({
            type: "POST",
            url:'Server.php',
            data: {
                sortAsec:cat,
            },
            success: (response)=>{
                let data = JSON.parse(response);    
                show_results(data);
            }
        });
    }

    const sortDesc = (cat)=>{
        $.ajax({
            type: "POST",
            url:'Server.php',
            data: {
                sortDesc:cat,
            },
            success: (response)=>{
                let data = JSON.parse(response);
                console.log(data);    
                show_results(data);
            }
        });
    }

    const show_results = (arr) =>{
        let table = `<table class="table" style="width: 100vw; text-align: center">
            <tr>
                <th class='t'>
                    <div style="display: flex; flex-direction : row; justify-content: center; align-items: center">
                        <p>Title</p>
                        <div style="display : flex ; flex-direction : column; justify-content: center">
                            <p style='padding:0;margin:0;margin-left:1vw'>
                                <i onclick="sortAsec('t')" class="fa-solid fa-angle-up"></i>
                            </p>
                            <p style='padding:0;margin:0;margin-left:1vw'>
                                <i onclick="sortDesc('r')" class="fa-solid fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                </th>
                <th class='r'>
                    <div style="display: flex; flex-direction : row; justify-content: center; align-items: center">
                        <p>Rating</p>
                        <div style="display : flex ; flex-direction : column; justify-content: center">
                            <p style='padding:0;margin:0;margin-left:1vw'>
                                <i onclick="sortAsec('t')" class="fa-solid fa-angle-up"></i>
                            </p>
                            <p style='padding:0;margin:0;margin-left:1vw'>
                                <i onclick="sortDesc('r')" class="fa-solid fa-angle-down"></i>
                            </p>
                        </div>
                    </div>
                </th>
                <th class='r'>
                    Delete
                </th>
            </tr>`;
        Object.keys(arr).map((item , rate)=>{
            table+= `
                        <tr>
                            <td>${item}</td>
                             <td>${arr[item]}</td>
                            <td><button onclick="delete_movie('${item}' , event)">Delete</button></td>
                        </tr>
                    `;
            
        })
        table+="</table>";
        $('#res').html(table);
    }
</script>
</html>