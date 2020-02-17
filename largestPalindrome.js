function largestPalindrome3 (digit1, digit2){

    var initialDigit1 = digit1;
    var notPalindrome = 0;
    var palindromes = [];
    var product;

for (k=0;k<digit1;k++){

    for(j=0;j<digit2;j++){

        notPalindrome = 0;

        product = digit1 * digit2;

        product = product.toString();

        for(i=0;i<product.length;i++){
            if(product.charAt(i) != product.charAt((product.length - 1) - i)){
                notPalindrome = 1;
            }
        }

        if(notPalindrome){
            digit1 = digit1 - 1;
        } else {
            palindromes.push(product);
            break;
        }

    }
    digit2 = digit2 - 1;
    digit1 = initialDigit1 - k + 1;
}

palindromes.sort((a, b) => b - a);

return palindromes[0];

}

console.log(largestPalindrome3(999,999));
