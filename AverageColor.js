var averageColor = function(color1, color2) {
    
    var r1, r2, r3, g1, g2, g3, b1, b2, b3; 

    r1 = parseInt(color1.charAt(0) + color1.charAt(1), 16);
    r2 = parseInt(color2.charAt(0) + color2.charAt(1), 16);
    r3 = Math.round((r1 + r2) / 2);
    r3 = r3.toString(16);

    g1 = parseInt(color1.charAt(2) + color1.charAt(3), 16);
    g2 = parseInt(color2.charAt(2) + color2.charAt(3), 16);
    g3 = Math.round((g1 + g2) / 2);
    g3 = g3.toString(16);

    b1 = parseInt(color1.charAt(4) + color1.charAt(5), 16);
    b2 = parseInt(color2.charAt(4) + color2.charAt(5), 16);
    b3 = Math.round((b1 + b2) / 2);
    b3 = b3.toString(16);
   
    return (r3 + g3 + b3).toUpperCase();
}

console.log(averageColor("660000", "99FF99"));
