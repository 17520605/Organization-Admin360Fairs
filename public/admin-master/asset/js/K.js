class K {
    constructor() {}

    static isResizing = false;

    static draggable (elements){
        for (let element of elements) {
            const el = element;
            var plane = null;
            if(el != null){
                plane = el.parentElement;
                el.addEventListener("mousedown", mousedown);
            }
            function mousedown(e) {
                
                let prevX = e.offsetX + el.offsetLeft;
                let prevY = e.offsetY + el.offsetTop;
                
                let oldLeft = el.offsetLeft;
                let oldTop = el.offsetTop;

                el.style.pointerEvents = 'none';
        
                function mousemove(e) {
                    if (!K.isResizing) {
                        let dX = e.offsetX - prevX;
                        let dY = e.offsetY - prevY;
        
                        let x =  oldLeft + dX;
                        let y =  oldTop + dY;

                        if(x < 0)
                            x = 0;
                        if(x + el.offsetWidth > plane.offsetWidth)
                            x = plane.offsetWidth - el.offsetWidth;

                        if(y < 0)
                            y = 0;
                        if(y + el.offsetHeight > plane.offsetHeight)
                            y = plane.offsetHeight - el.offsetHeight;
                        
                        el.style.left = x + "px";
                        el.style.top = y + "px";
                        
                    }
                }
        
                function mouseup() {
                    plane.removeEventListener("mousemove", mousemove);
                    plane.removeEventListener("mouseup", mouseup);
                    document.removeEventListener("mouseup", mouseup);
                    el.style.pointerEvents = 'auto';
                }

                plane.addEventListener("mousemove", mousemove);
                plane.addEventListener("mouseup", mouseup);
                document.addEventListener("mouseup", mouseup);
            }
        }
    }

    static resizable (elements) {  
        for (let element of elements) {
            const el = element;
            const resizers = el.querySelectorAll(".resizer");
            var plane = null;
            if(el != null){
                plane = el.parentElement;
            }

            let currentResizer;

            for (let resizer of resizers) {
                function mousedown(e) {
                    currentResizer = e.currentTarget;
                    K.isResizing = true;
                    
                    let prevX = e.offsetX + currentResizer.offsetLeft + el.offsetLeft;
                    let prevY = e.offsetY + currentResizer.offsetTop + el.offsetTop;

                    let oldLeft = el.offsetLeft;
                    let oldTop = el.offsetTop;

                    let oldWidth = el.offsetWidth;
                    let oldHeight = el.offsetHeight;

                    el.style.pointerEvents = 'none';

                    function mousemove(e) {
                        if(K.isResizing){
                            let top = oldTop;
                            let left = oldLeft;
                            let width = oldWidth;
                            let height = oldHeight;
                            let dX = e.offsetX - prevX;
                            let dY = e.offsetY - prevY;
                        
                            if (currentResizer.classList.contains("se")) {
                                width = oldWidth + dX;
                                height = oldHeight + dY;
                                if(left + width > plane.offsetWidth)
                                    width = plane.offsetWidth - left;
                                if(top + height > plane.offsetHeight)
                                    height = plane.offsetHeight - top;
                                if(width < 20)
                                    width = 20;
                                if(height < 20)
                                    height = 20;
                            }
                            else if (currentResizer.classList.contains("sw")) {
                                width = oldWidth - dX;
                                height = oldHeight + dY;
                                left = oldLeft + dX;
                                if(left < 0){
                                    left = 0;
                                    width = oldWidth + oldLeft;
                                }
                                if( left > oldLeft + oldWidth - 20){
                                    left = oldLeft + oldWidth - 20;
                                    width = 20;
                                }
                                
                                if(height > oldTop + oldHeight){
                                    height = oldTop + oldHeight;
                                }
                                if(height < 20){
                                    height = 20;
                                }
                            }
                            else if (currentResizer.classList.contains("ne")) {
                                width = oldWidth + dX;
                                height = oldHeight - dY;
                                top =  oldTop + dY;
                                if(top < 0){
                                    top = 0;
                                    height = oldHeight + oldTop;
                                }
                                if(top > oldTop + oldHeight - 20){
                                    top = oldTop + oldHeight - 20;
                                    height = 20;
                                }
                                if(width > plane.offsetWidth - oldLeft){
                                    width = plane.offsetWidth - oldLeft;
                                }
                                if(width < 20){
                                    width = 20;
                                }
                            }
                            else if (currentResizer.classList.contains("nw")) { 
                                width = oldWidth - dX;
                                height = oldHeight - dY;
                                left = oldLeft + dX;
                                top =  oldTop + dY;

                                if(left < 0){
                                    left = 0;
                                    width = oldWidth + oldLeft;
                                }
                                if( left > oldLeft + oldWidth - 20){
                                    left = oldLeft + oldWidth - 20;
                                    width = 20;
                                }
                                if(top < 0){
                                    top = 0;
                                    height = oldHeight + oldTop;
                                }
                                if(top > oldTop + oldHeight - 20){
                                    top = oldTop + oldHeight - 20;
                                    height = 20;
                                }
                            }

                            el.style.width =  width + "px";
                            el.style.height =  height + "px";
                            el.style.top =  top + "px";
                            el.style.left =  left + "px";
                        }
                    }

                    function mouseup() {
                        plane.removeEventListener("mousemove", mousemove);
                        plane.removeEventListener("mouseup", mouseup);
                        document.removeEventListener("mouseup", mouseup);
                        K.isResizing = false;
                        el.style.pointerEvents = 'auto';
                    }

                    plane.addEventListener("mousemove", mousemove);
                    plane.addEventListener("mouseup", mouseup);
                    document.addEventListener("mouseup", mouseup); 
                }

                resizer.addEventListener("mousedown", mousedown);
            }
        }
    }
}

class K_URL {
    constructor(url) {
        this.url = url;
    }

    static YouTube (url){
        const originalUrl = url;
        let id = "";
        // https://youtu.be/qiI4XNUoiyg
        if(url.startsWith('https://youtu.be/')){
            id = url.replace('https://youtu.be/', '');
        }
        // https://www.youtube.com/watch?v=qiI4XNUoiyg&list=RDMMqiI4XNUoiyg&start_radio=1&ab_channel=FORESTSTUDIO
        else if(url.startsWith("https://www.youtube.com/watch?")){
            id = new URL(url).searchParams.get('v');
        }
        // https://www.youtube.com/embed/qiI4XNUoiyg
        else if(url.startsWith("https://www.youtube.com/embed/")){
            id = url.replace('https://www.youtube.com/embed/');
        }
        else{
            return null;
        }
    
        let yt = {
            originalUrl : originalUrl,
            id: id,
            embedUrl : 'https://www.youtube.com/embed/' + id,
            watchUrl : 'https://www.youtube.com/watch?v=' + id,
            getInfo: async function () {  
                var ytApiKey = "AIzaSyC66xDpUMpGAwmwHd45xfVY3qKmgiOMkfI";
                let rs = await $.ajax({
                    //headers: {  'Access-Control-Allow-Origin': 'https://tools.360fairs.com' },
                    url: "https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" + id + "&key=" + ytApiKey,
                    crossDomain: true,
                    dataType: 'jsonp',
                    type: 'get'
                });
                return rs.items[0].snippet
            }
        }

        return yt;
    }

    static File (url){
        let f = {
            originalUrl : url,
            check : async function () {  
                let minetype = null;
                try {
                    let rs = await $.ajax({
                        type: "GET",
                        url: url, 
                        crossDomain: true,
                        success: function(response, status, xhr){ 
                            minetype = xhr.getResponseHeader("content-type");
                        },
                        error: function (response) {
                            error = response.responseText;
                            minetype = null;
                        }
                    });
                } catch (error) {
                    minetype = null;
                }
                if(minetype != null){
                    minetype = {
                        type: minetype.split("/")[0],
                        extention: minetype.split("/")[1],
                    }
                }
                return minetype;
            },
        };

        return f;

        // isImage: function () {  
        //     let obj = new URL(originalUrl);
        //     let conn = obj.openConnection();

        //     //Get all headers
        //     let map = conn.getHeaderFields();
        //     for (let entry in map.entrySet()) {
        //         System.out.println("Key : " + entry.getKey() +
        //                     " ,Value : " + entry.getValue());
        //     }

        //     //get header by 'key'
        //     let content_type = conn.getHeaderField("Content-Type");
        // }
    }
}