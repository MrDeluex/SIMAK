import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    
    theme: {
        plugins: [
            require('@tailwindcss/aspect-ratio'),
            require("@designbycode/tailwindcss-text-stroke"),
          ],
        extend: {
            fontFamily: {
                sans: ['Poppins', 'sans-serif'], // Ganti font utama Tailwind menjadi Poppins
              },

            colors: {
                primary: {
                    1 :'#d9d9d9',
                    2 :'#d8d8d8',
                    3 :'#dfdfdf',
                    4 :'#dddddd',
                },

                secondary: {
                    1 : '#1F2688',
                    2 : '#1E2697',
                },

                button: {
                    true : '#1E974E',
                    false : '#D40E0E',
                },

                custom: {
                    1 : '#2D2D2D',
                }
            },

            aspectRatio: {
                '108/79': '108 / 79',
                '1/1': '1 / 1',
              },

            zIndex: {
            '75': 75,
            '1000': 1000,
            'auto': 'auto',
            },

            spacing: {
                'min40': '-10rem', 
                'min30': '-7.5rem', 
                'min39': '-9.75rem', 
                'min19': '-4.75rem', 
                '15': '3.75rem', 
                '17': '4.25rem', 
                '18': '4.5rem', 
                '19': '4.75rem', 
                '14': '3.5rem', 
                '22': '5.5rem', 
                '26': '6.5rem', 
                '30': '7.5rem',     
                '33': '7.75rem',     
                '35': '8.25rem',     
                '37': '8.75rem',     
                '38': '9.5rem',     
                '39': '9.75rem',     
                '42': '10.5rem',     
                '43': '10.75rem',     
                '45': '11.25rem',
                '46': '11.5rem',
                '49': '12.25rem',
                '50': '12.5rem',
                '53': '13.25rem',
                '55': '13.75rem',
                '57': '14.5rem',
                '58': '14.5rem',
                '59': '14.75rem',
                '63': '15.75rem',
                '66': '16.5rem',
                '68': '17rem',
                '71': '17.75rem',
                '78': '19.5rem',
                '79': '19.75rem',
                '86': '21.5rem',
                '88': '22rem',
                '91': '22.75rem',
                '95' : '23.75rem',
                '98' : '24.5rem',
                '100' : '25rem',
                '103' : '25.75rem',
                '105' : '26.25rem',
                '108' : '27rem',
                '112' : '28rem',
                '119' : '29.75rem',
                '120' : '30rem',
                '123' : '30.25rem',
                '124' : '31rem',
                '126' : '32rem',
                '140' : '35rem',
                '152' : '38rem',
                '154' : '38.5rem',
                '169' : '42.25rem',
                '170' : '42.5rem',
                '189' : '47.25rem',
                '194' : '48.5rem',
                '212' : '53rem',
                '220' : '55rem',
            },

            fontSize: {
                'xxs': '0.5rem',
                '3.5xl': '2rem',
                '6.5xl': '4rem',
                '7.5xl': '5rem',
            },

            screens: {
                'sm': { 'max': '460px' },
              },
            
            dropShadow: {
                '1': '0 4px 4px rgba(0, 0, 0, 0.25)',
                '2': '0 5px 4px rgba(0, 0, 0, 0.25)',
            },
        },
    },
    plugins: [],
};
