<script>
function makeRand(max){
        // Generating random number from 0 to max (argument)
        return Math.floor(Math.random() * max);
}
function generatePass(ElementById){
        // password Lenght
        var length = 8;
        var result = '';
        // allowed characters
        var symbols = new Array(
                                'q','w','e','r','t','y','u','i','o','p',
                                'a','s','d','f','g','h','j','k','l',
                                'z','x','c','v','b','n','m',
                                'Q','W','E','R','T','Y','U','I','O','P',
                                'A','S','D','F','G','H','J','K','L',
                                'Z','X','C','V','B','N','M',
                                1,2,3,4,5,6,7,8,9,0
        );
        for (i = 0; i < length; i++){
                result += symbols[makeRand(symbols.length)];
        }        
        document.getElementById(ElementById).value = result;
		//return result;       
}
</script>