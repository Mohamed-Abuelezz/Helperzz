<style>
    .bg_load {
        display: flex;
        align-items: center;
        justify-content: center;

    }

    /* Animation */
    @-webkit-keyframes rotate {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes rotate {
        to {
            transform: rotate(360deg);
        }
    }

    /* Variables */
    /* Loading Icon */
    .loading {
        width: 100px;
        height: 100px;
    }

    .loading__ring {
        position: absolute;
        width: 100px;
        height: 100px;
    }

    .loading__ring:first-child {
        transform: skew(30deg, 20deg);
    }

    .loading__ring:last-child {
        transform: skew(-30deg, -20deg) scale(-1, 1);
    }

    .loading__ring:last-child svg {
        -webkit-animation-delay: -0.5s;
        animation-delay: -0.5s;
    }

    .loading__ring svg {
        -webkit-animation: rotate 1s linear infinite;
        animation: rotate 1s linear infinite;
        fill: white;
    }

</style>


<div class="bg_load ">
    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="200.000000pt" height="200.000000pt" 
        viewBox="0 0 300.000000 300.000000" preserveAspectRatio="xMidYMid meet" >
        <g transform="translate(0.000000,300.000000) scale(0.100000,-0.100000)"  fill="white" enable-background="new 0 0 320 100" stroke="none">
            <path
                d="M2067 2102 c-56 -19 -112 -69 -147 -132 -34 -62 -35 -165 -2 -230 22 -42 92 -130 92 -115 0 3 18 -4 40 -16 22 -13 40 -26 40 -31 0 -8 -23 -12 -49 -9 -8 2 -10 -2 -5 -10 5 -9 2 -10 -9 -6 -10 3 -17 3 -17 -2 0 -5 -14 -14 -30 -21 -32 -13 -137 -111 -156 -145 -12 -21 -23 -23 -66 -11 -18 5 -25 13 -21 22 3 8 8 13 10 10 3 -3 12 1 20 9 8 8 22 20 32 27 27 20 61 100 61 144 0 22 -11 61 -26 90 -21 41 -37 58 -76 79 -44 24 -58 27 -113 23 -59 -5 -110 -27 -128 -55 -4 -7 -14 -19 -23 -28 -8 -8 -13 -15 -10 -15 3 0 -2 -16 -10 -35 -7 -19 -14 -47 -14 -63 0 -42 50 -134 87 -158 18 -12 29 -24 26 -28 -4 -3 0 -6 8 -6 8 -1 -11 -11 -41 -24 l-55 -24 -31 36 c-33 38 -112 84 -174 101 -30 8 -32 9 -10 11 14 1 28 2 33 1 4 0 7 4 7 9 0 6 5 10 10 10 22 0 77 55 95 95 36 80 39 136 9 200 -12 28 -31 59 -42 70 -26 27 -62 56 -62 50 0 -2 -16 3 -35 11 -42 17 -87 18 -143 1 -128 -39 -198 -192 -142 -315 20 -43 85 -112 108 -112 6 0 12 -8 12 -17 0 -11 3 -14 8 -7 4 6 16 8 27 4 16 -6 14 -8 -15 -13 -27 -5 -47 -1 -84 18 -27 14 -58 25 -68 25 -32 0 -90 -29 -113 -56 -26 -30 -30 -26 -39 36 -21 145 -229 176 -303 45 -40 -71 -25 -153 38 -214 33 -31 33 -31 11 -37 -12 -4 -22 -10 -22 -15 0 -5 -6 -9 -13 -9 -19 0 -75 -64 -94 -107 -25 -57 -41 -162 -31 -201 5 -18 19 -43 31 -55 21 -21 30 -22 292 -25 274 -3 352 1 324 19 -9 5 46 10 146 11 l160 2 -143 3 c-125 3 -143 6 -138 19 3 9 6 18 6 20 0 2 12 -3 26 -13 21 -13 30 -14 45 -5 14 9 25 9 44 0 19 -8 28 -9 37 0 8 8 17 8 31 1 11 -6 33 -8 49 -5 19 4 41 -1 65 -14 l35 -19 -43 -4 c-24 -2 35 -3 131 -3 172 0 173 0 50 6 -122 6 -120 6 80 10 131 2 187 6 155 10 l-50 7 53 1 c29 1 62 6 72 12 13 7 19 6 23 -5 3 -7 1 -16 -6 -19 -7 -2 2 -5 18 -5 22 -1 26 -4 16 -10 -29 -18 34 -22 297 -19 l261 3 31 30 c18 17 38 42 46 57 30 57 21 211 -17 295 -10 24 -19 45 -19 48 0 15 -75 121 -111 156 -22 22 -75 57 -117 78 l-77 39 49 22 c119 54 180 192 142 321 -16 56 -77 139 -102 139 -8 0 -14 4 -14 8 0 14 -99 42 -144 41 -22 0 -63 -8 -89 -17z m199 -30 c147 -75 185 -256 79 -379 -49 -57 -106 -83 -185 -83 -210 0 -322 238 -188 400 24 29 83 68 118 79 48 14 130 7 176 -17z m-995 -154 c133 -39 192 -208 113 -321 -86 -123 -270 -120 -348 6 -77 125 -20 274 124 318 37 11 68 10 111 -3z m456 -169 c59 -22 113 -100 113 -164 0 -46 -34 -109 -76 -141 -33 -25 -46 -29 -104 -29 -57 0 -72 4 -103 28 -61 46 -86 116 -67 186 13 49 53 99 95 117 37 16 104 18 142 3z m-987 -157 c74 -37 102 -131 60 -200 -79 -130 -280 -69 -267 81 2 27 13 61 24 75 24 34 79 62 118 62 17 0 46 -8 65 -18z m1387 -8 c-3 -3 -12 -4 -19 -1 -8 3 -5 6 6 6 11 1 17 -2 13 -5z m90 0 c-3 -3 -12 -4 -19 -1 -8 3 -5 6 6 6 11 1 17 -2 13 -5z m42 -43 c169 -52 287 -226 298 -436 5 -103 -9 -143 -67 -182 -32 -22 -40 -23 -284 -23 l-251 0 -32 50 c-18 27 -33 52 -33 55 0 3 16 27 36 55 l35 49 -460 0 -461 0 36 -53 35 -54 -33 -51 -33 -51 -273 0 -274 0 -29 29 c-24 25 -29 38 -29 78 0 150 111 282 236 283 51 0 137 -42 164 -80 26 -36 43 -30 64 22 15 39 15 42 -3 55 -11 7 -25 29 -31 48 -40 121 110 215 200 125 19 -19 25 -20 57 -9 21 7 66 10 108 7 88 -6 141 -33 208 -108 37 -41 47 -47 56 -36 7 8 32 24 56 35 62 29 155 28 215 -2 l44 -23 39 59 c48 72 128 133 204 157 75 24 127 24 202 1z m-1416 -150 c-4 -29 1 -51 20 -89 21 -42 23 -53 13 -68 -12 -16 -15 -16 -36 9 -13 15 -30 27 -37 27 -7 0 -13 5 -13 10 0 6 -7 10 -15 10 -24 0 -18 19 16 53 17 17 36 44 41 59 14 39 17 35 11 -11z m268 -328 c-12 -20 -14 -14 -5 12 4 9 9 14 11 11 3 -2 0 -13 -6 -23z m291 -40 c4 -78 4 -78 -17 -70 -21 9 -22 137 -1 137 11 0 15 -18 18 -67z m-228 32 c-5 -21 -3 -25 15 -25 16 0 21 6 21 25 0 17 6 25 18 25 14 0 17 -10 17 -65 0 -55 -3 -65 -17 -65 -12 0 -18 8 -18 25 0 19 -5 25 -21 25 -18 0 -20 -4 -15 -25 5 -20 3 -25 -14 -25 -18 0 -20 6 -20 65 0 59 2 65 20 65 17 0 19 -5 14 -25z m159 18 c-7 -2 -21 -2 -30 0 -10 3 -4 5 12 5 17 0 24 -2 18 -5z m154 1 c-3 -3 -12 -4 -19 -1 -8 3 -5 6 6 6 11 1 17 -2 13 -5z m53 -4 c0 -13 -12 -19 -26 -13 -8 3 -12 8 -9 12 5 10 35 10 35 1z m80 -2 c0 -5 -12 -5 -27 -2 -40 10 -42 15 -5 12 18 -1 32 -6 32 -10z m87 6 c-3 -3 -12 -4 -19 -1 -8 3 -5 6 6 6 11 1 17 -2 13 -5z m81 -1 c-10 -2 -28 -2 -40 0 -13 2 -5 4 17 4 22 1 32 -1 23 -4z m107 -2 c-6 -5 -28 -6 -50 -1 l-40 8 50 1 c29 1 45 -3 40 -8z m-557 -33 c7 -7 12 -20 12 -30 0 -14 -8 -18 -32 -18 -34 0 -32 -12 2 -14 28 -1 30 -20 2 -24 -28 -4 -62 23 -62 49 0 38 52 63 78 37z m170 -26 c4 -40 -14 -65 -41 -58 -15 4 -18 0 -14 -15 4 -14 0 -19 -14 -19 -17 0 -19 8 -19 64 l0 65 43 -2 c40 -2 42 -4 45 -35z m100 6 c3 -24 0 -28 -23 -28 -15 0 -24 -4 -20 -10 4 -6 13 -9 20 -8 8 2 15 -1 17 -7 5 -15 -41 -18 -58 -5 -17 15 -18 62 -2 78 7 7 24 12 38 10 19 -2 26 -10 28 -30z m92 21 c0 -4 -9 -13 -20 -19 -13 -7 -20 -21 -20 -40 0 -20 -5 -30 -15 -30 -11 0 -15 12 -15 49 l0 49 35 0 c19 0 35 -4 35 -9z m80 2 c0 -4 -9 -20 -20 -34 -11 -14 -20 -27 -20 -30 0 -3 9 -3 20 0 14 4 20 0 20 -11 0 -12 -10 -16 -40 -16 -28 0 -40 4 -40 14 0 8 4 18 10 21 5 3 15 15 20 25 8 16 8 18 -5 14 -10 -4 -15 0 -15 10 0 12 10 16 35 16 19 0 35 -4 35 -9z m90 0 c0 -4 -9 -20 -20 -34 -11 -14 -20 -27 -20 -30 0 -3 9 -3 20 0 14 4 20 0 20 -11 0 -12 -10 -16 -40 -16 -44 0 -48 8 -24 45 15 23 15 25 0 25 -9 0 -16 7 -16 15 0 11 11 15 40 15 22 0 40 -4 40 -9z m-340 -99 c0 -12 121 -12 143 -1 10 6 17 6 17 0 0 -5 15 -11 33 -14 17 -2 -33 -4 -113 -5 -128 -1 -142 0 -120 12 30 17 40 19 40 8z" />
            <path d="M1295 1020 c-3 -5 1 -10 9 -10 9 0 16 5 16 10 0 6 -4 10 -9 10 -6 0 -13 -4 -16 -10z" />
            <path d="M1454 1016 c-8 -21 3 -49 16 -41 5 3 10 15 10 25 0 25 -18 36 -26 16z" />
            <path d="M1560 1020 c0 -5 7 -10 16 -10 8 0 12 5 9 10 -3 6 -10 10 -16 10 -5 0 -9 -4 -9 -10z" />
            <path d="M1708 893 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z" />
        </g>
    </svg>



    <div class="loading">
        <div class="loading__ring">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px"
                y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                <path
                    d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                </path>
            </svg>
        </div>
        <div class="loading__ring">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px"
                y="0px" viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve">
                <path
                    d="M85.5,42c-0.2-0.8-0.5-1.7-0.8-2.5c-0.3-0.9-0.7-1.6-1-2.3c-0.3-0.7-0.6-1.3-1-1.9c0.3,0.5,0.5,1.1,0.8,1.7  c0.2,0.7,0.6,1.5,0.8,2.3s0.5,1.7,0.8,2.5c0.8,3.5,1.3,7.5,0.8,12c-0.4,4.3-1.8,9-4.2,13.4c-2.4,4.2-5.9,8.2-10.5,11.2  c-1.1,0.7-2.2,1.5-3.4,2c-0.5,0.2-1.2,0.6-1.8,0.8s-1.3,0.5-1.9,0.8c-2.6,1-5.3,1.7-8.1,1.8l-1.1,0.1L53.8,84c-0.7,0-1.4,0-2.1,0  c-1.4-0.1-2.9-0.1-4.2-0.5c-1.4-0.1-2.8-0.6-4.1-0.8c-1.4-0.5-2.7-0.9-3.9-1.5c-1.2-0.6-2.4-1.2-3.7-1.9c-0.6-0.3-1.2-0.7-1.7-1.1  l-0.8-0.6c-0.3-0.1-0.6-0.4-0.8-0.6l-0.8-0.6L31.3,76l-0.2-0.2L31,75.7l-0.1-0.1l0,0l-1.5-1.5c-1.2-1-1.9-2.1-2.7-3.1  c-0.4-0.4-0.7-1.1-1.1-1.7l-1.1-1.7c-0.3-0.6-0.6-1.2-0.9-1.8c-0.2-0.5-0.6-1.2-0.8-1.8c-0.4-1.2-1-2.4-1.2-3.7  c-0.2-0.6-0.4-1.2-0.5-1.9c-0.1-0.6-0.2-1.2-0.3-1.8c-0.3-1.2-0.3-2.4-0.4-3.7c-0.1-1.2,0-2.5,0.1-3.7c0.2-1.2,0.3-2.4,0.6-3.5  c0.1-0.6,0.3-1.1,0.4-1.7l0.1-0.8l0.3-0.8c1.5-4.3,3.8-8,6.5-11c0.8-0.8,1.4-1.5,2.1-2.1c0.9-0.9,1.4-1.3,2.2-1.8  c1.4-1.2,2.9-2,4.3-2.8c2.8-1.5,5.5-2.3,7.7-2.8s4-0.7,5.2-0.6c0.6-0.1,1.1,0,1.4,0s0.4,0,0.4,0h0.1c2.7,0.1,5-2.2,5-5  c0.1-2.7-2.2-5-5-5c-0.2,0-0.2,0-0.3,0c0,0-0.2,0.1-0.6,0.1c-0.4,0-1,0-1.8,0.1c-1.6,0.1-4,0.4-6.9,1.2c-2.9,0.8-6.4,2-9.9,4.1  c-1.8,1-3.6,2.3-5.4,3.8C26,21.4,25,22.2,24.4,23c-0.2,0.2-0.4,0.4-0.6,0.6c-0.2,0.2-0.5,0.4-0.6,0.7c-0.5,0.4-0.8,0.9-1.3,1.4  c-3.2,3.9-5.9,8.8-7.5,14.3l-0.3,1l-0.2,1.1c-0.1,0.7-0.3,1.4-0.4,2.1c-0.3,1.5-0.4,2.9-0.5,4.5c0,1.5-0.1,3,0.1,4.5  c0.2,1.5,0.2,3,0.6,4.6c0.1,0.7,0.3,1.5,0.4,2.3c0.2,0.8,0.5,1.5,0.7,2.3c0.4,1.6,1.1,3,1.7,4.4c0.3,0.7,0.7,1.4,1.1,2.1  c0.4,0.8,0.8,1.4,1.2,2.1c0.5,0.7,0.9,1.4,1.4,2s0.9,1.3,1.5,1.9c1.1,1.3,2.2,2.7,3.3,3.5l1.7,1.6c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0  c0,0,0,0,0,0l0.1,0.1l0.1,0.1h0.2l0.5,0.4l1,0.7c0.4,0.2,0.6,0.5,1,0.7l1.1,0.6c0.8,0.4,1.4,0.9,2.1,1.2c1.4,0.7,2.9,1.5,4.4,2  c1.5,0.7,3.1,1,4.6,1.5c1.5,0.3,3.1,0.7,4.7,0.8c1.6,0.2,3.1,0.2,4.7,0.2c0.8,0,1.6-0.1,2.4-0.1l1.2-0.1l1.1-0.1  c3.1-0.4,6.1-1.3,8.9-2.4c0.8-0.3,1.4-0.6,2.1-0.9s1.3-0.7,2-1.1c1.3-0.7,2.6-1.7,3.7-2.5c0.5-0.4,1-0.9,1.6-1.3l0.8-0.6l0.2-0.2  c0,0,0.1-0.1,0.1-0.1c0.1-0.1,0,0,0,0v0.1l0.1-0.1l0.4-0.4c0.5-0.5,1-1,1.5-1.5c0.3-0.3,0.5-0.5,0.8-0.8l0.7-0.8  c0.9-1.1,1.8-2.2,2.5-3.3c0.4-0.6,0.7-1.1,1.1-1.7c0.3-0.7,0.6-1.2,0.9-1.8c2.4-4.9,3.5-9.8,3.7-14.4C87.3,49.7,86.6,45.5,85.5,42z">
                </path>
            </svg>
        </div>
    </div>
</div>
