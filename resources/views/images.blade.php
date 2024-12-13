   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Llistat d'imatges</h1>
    @foreach ($images as $image)
        <p>Imatge: {{ $image->id}} -- {{$image->image_path }}</p>
        <p>Descripció: {{ $image -> description}}</p>
        <p>Imatge de: {{ $image-> user->name}} {{ $image-> user->surname }}</p>
        <p>LIKES: {{count($image->likes) }}</p>
        @if (count($image->comments)>0)

            <h4>Comentaris</h4>
            @foreach ($image->comments as $comment)
                <p>{{ $comment->user->name}}: {{ $comment->content}}</p>

            @endforeach
        @endif
        <hr>
        @endforeach
      
    
</body>
</html>