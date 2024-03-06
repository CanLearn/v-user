<?php

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "http://backend.test.chaleshsoft.com/api/panel/video-landing/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"title\"\r\n\r\nمتن ساختگی\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"video\"; filename=\"y2mate.is - Introducing iPhone 15 WOW Apple-XHTrLYShBRQ-480pp-1709561806.mp4\"\r\nContent-Type: video/mp4\r\n\r\n\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"content\"\r\n\r\nلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"title_en\"\r\n\r\naliquet\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"video_en\"; filename=\"y2mate.is - iPhone 15 Ceramic Shield Swoop Apple-TPq4XRgC5gQ-480pp-1709561943.mp4\"\r\nContent-Type: video/mp4\r\n\r\n\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"content_en\"\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas purus viverra accumsan in nisl nisi. Arcu cursus vitae congue mauris rhoncus aenean vel elit scelerisque. In egestas erat imperdiet sed euismod nisi porta lorem mollis. Morbi tristique senectus et netus. Mattis pellentesque id nibh tortor id aliquet lectus proin. Sapien faucibus et molestie ac feugiat sed lectus vestibulum. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget. Dictum varius duis at consectetur lorem. Nisi vitae suscipit tellus mauris a diam maecenas sed enim. Velit ut tortor pretium viverra suspendisse potenti nullam. Et molestie ac feugiat sed lectus. Non nisi est sit amet facilisis magna. Dignissim diam quis enim lobortis scelerisque fermentum. Odio ut enim blandit volutpat maecenas volutpat. Ornare lectus sit amet est placerat in egestas erat. Nisi vitae suscipit tellus mauris a diam maecenas sed. Placerat duis ultricies lacus sed turpis tincidunt id aliquet.\r\n-----011000010111000001101001--\r\n",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer 8|sKajXyv1zr6igkWv7log8mDiorpA6AfD699WAgPh269daeb2",
        "Content-Type: multipart/form-data; boundary=---011000010111000001101001",
        "User-Agent: insomnia/8.5.1"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
