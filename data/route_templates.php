<?
$routeTemplates =
	[
		[
		"controller_class_name" => DIRECTORY_SEPARATOR."pages".DIRECTORY_SEPARATOR."blog".DIRECTORY_SEPARATOR."ControllerBlog",
		"root_path"             => "/blog/",
		"path_array"            =>
			[
			"list"            => "",
			"page_detail"     => "#ITEM_ID#/",
			"comments_detail" => "#ITEM_ID#/comments/#COMMENT_ID#/"
			]
		],
		[
		"controller_class_name" => "ControllerTestPage",
		"root_path"             => "/test_page/"
		]
	];