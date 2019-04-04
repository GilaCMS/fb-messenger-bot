# fb-messenger-bot
A simple Messenger Bot that uses regex expressions

This is a package for (Gila CMS)[https://github.com/GilaCMS/gila]

# Templates responses
Direct Message
```
return [ 'text' => "Hello" ];
```

Generic Template
```
return ["attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"generic",
      "elements"=>[
        [
          "title"=>"Gila CMS",
          "image_url"=>"https://gilacms.com/assets/gila-logo.png",
          "subtitle"=>"News and updates.",
          "buttons"=>[
            [
              "type"=>"web_url",
              "url"=>"https://gilacms.com",
              "title"=>"View Website"
            ],
            [
              "type"=>"postback",
              "title"=>"Start Chatting",
              "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
            ]              
          ]
        ]
      ]
  ]]];
```

Button
```
return ["attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"button",
      "text"=>"What do you want to do next?",
      "buttons"=>[
        [
          "type"=>"web_url",
          "url"=>"https://gilacms.com/",
          "title"=>"Show Website"
        ],
        [
          "type"=>"postback",
          "title"=>"Start Chatting",
          "payload"=>"USER_DEFINED_PAYLOAD"
        ]
      ]
    ]
  ]];
```

List
```
return [
    "attachment"=>[
    "type"=>"template",
    "payload"=>[
      "template_type"=>"list",
      "elements"=>[
        [
          "title"=> "Plastic filaments",
            "image_url"=> "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/3D_Printing_Materials_%2816837486456%29.jpg/800px-3D_Printing_Materials_%2816837486456%29.jpg",
            "subtitle"=> "See all our colors",
            "default_action"=> [
              "type"=> "web_url",
              "url"=> "https://www.gilacms.com",                       
              "webview_height_ratio"=> "tall",
            ],
          "buttons"=>[
            [
              "type"=>"web_url",
              "url"=>"https://www.gilacms.com/#",
              "title"=>"Buy Now"
            ],
          ]
        ],
        [
          "title"=> "Plastic filaments",
            "image_url"=> "https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/3D_Printing_Materials_%2816837486456%29.jpg/800px-3D_Printing_Materials_%2816837486456%29.jpg",
            "subtitle"=> "See all our colors",
            "default_action"=> [
              "type"=> "web_url",
              "url"=> "https://www.gilacms.com",                       
              "webview_height_ratio"=> "tall",
            ],
          "buttons"=>[
            [
              "type"=>"web_url",
              "url"=>"https://www.gilacms.com/#",
              "title"=>"Buy Now"
            ],
          ]
        ]
      ]
  ]]];
```

