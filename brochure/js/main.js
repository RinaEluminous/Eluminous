$(document).ready(function () {
    $("#container").flipBook({
        btnShare: false,
        pages:[
            {
                src:"images/book1/cover.jpg",
                thumb:"images/book1/cover.jpg",
                title:"Introduction"
            },
            {
                src:"images/book1/page2-1.jpg",
                thumb:"images/book1/page2-1.jpg",
                title:"Key Highlights"
               
            },
            {
                src:"images/book1/page2-2.jpg",
                thumb:"images/book1/page2-2.jpg",
                 title:"Web Development"
            },
            {
                src:"images/book1/page3-1.jpg",
                thumb:"images/book1/page3-1.jpg",
                title:"Conversion Rate Optimization"
            },
            {
                src:"images/book1/page3-2.jpg",
                thumb:"images/book1/page3-2.jpg",
                title:"Why eLuminous ?"
            },
            {
                src:"images/book1/page4-1.jpg",
                thumb:"images/book1/page4-1.jpg",
                title:"Clientele"
            },
            {
                src:"images/book1/page4-2.jpg",
                thumb:"images/book1/page4-2.jpg",
                title:"Our Offices"
            },
            {
                src:"images/book1/last-page1.jpg",
                thumb:"images/book1/last-page1.jpg",
                title:"Connect with us"
            }
        ]
    });
})
