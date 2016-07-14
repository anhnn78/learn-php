
function draw(){


  var canvas = document.getElementById('canvas');

  if (canvas.getContext){

  var ctx = canvas.getContext('2d');

// Đầu tiên vẽ nền đỏ trước

  ctx.fillStyle = "rgb(255,0,0)";

  ctx.fillRect (0, 0, 500, 300);

// Để vẽ sharp cần có .beginPath()

   ctx.beginPath();

// Chọn màu ngôi sao là màu vàng

    ctx.fillStyle   = 'yellow';

// Chỉ ra tọa độ bắt đầu (x,y) dựa theo width và height trong html      

   ctx.moveTo(250,80); 

// Bắt đầu vẽ   

    ctx.lineTo(200,200);

   ctx.lineTo(320,125);

   ctx.lineTo(180,125);

   ctx.lineTo(300,200);

   ctx.closePath();

// Vẽ xong cần tô màu   

   ctx.fill();   

  }

} 


