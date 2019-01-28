import Color from "color"

const ColorDarkenPlugin = {
    install(Vue, options) {
        Vue.prototype.$colorDarken = function (color, amt) {
            let colorObj = Color(color);
            let hex = colorObj.hex();
            amt = amt || -20;

            let usePound = false;

            if (hex[0] === "#") {
                hex = hex.slice(1);
                usePound = true;
            }

            let num = parseInt(hex, 16);

            let r = (num >> 16) + amt;

            if (r > 255) r = 255;
            else if (r < 0) r = 0;

            let b = ((num >> 8) & 0x00FF) + amt;

            if (b > 255) b = 255;
            else if (b < 0) b = 0;

            let g = (num & 0x0000FF) + amt;

            if (g > 255) g = 255;
            else if (g < 0) g = 0;

            return Color((usePound?"#":"") + String("000000" + (g | (b << 8) | (r << 16)).toString(16)).slice(-6))
        }
    }
};

export default ColorDarkenPlugin