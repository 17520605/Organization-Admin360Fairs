class Utils {
    static convertToCurrency(amount, currency = 'VND') {  
        let int = parseInt(amount);
        if(int){
            int = int.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
            int = int.replace('VND', '');
            int = int + currency;
        };
        return int;
    }

    static convertToSlug(str) {  
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();

        // remove accents, swap ñ for n, etc
        var from = "ăắằặẵẳâấầậẩẫạảãàáäâêếềệểễẹẻẽèéëêịỉìíïîôốồộổỗơớờợởỡọỏõòóöôưựứừửữụủùúüûñçđ·/_,:;";
        var to   = "aaaaaaaaaaaaaaaaaaaeeeeeeeeeeeeeiiiiiiooooooooooooooooooouuuuuuuuuuuuncd------";
        for (var i = 0, l = from.length; i < l; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // collapse whitespace and replace by -
                .replace(/-+/g, '-'); // collapse dashes

        return str;
    }
}

