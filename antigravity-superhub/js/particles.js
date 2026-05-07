// Quantum Particle System
(function(){
  const canvas=document.getElementById('particles');
  if(!canvas)return;
  const ctx=canvas.getContext('2d');
  let W,H,particles=[],mouse={x:-999,y:-999};
  const COUNT=80,MAX_DIST=120;

  function resize(){W=canvas.width=window.innerWidth;H=canvas.height=window.innerHeight;}
  window.addEventListener('resize',resize);resize();

  class P{
    constructor(){this.reset();}
    reset(){
      this.x=Math.random()*W;this.y=Math.random()*H;
      this.vx=(Math.random()-.5)*.4;this.vy=(Math.random()-.5)*.4;
      this.r=Math.random()*2+.5;
      this.a=Math.random()*.4+.1;
      this.hue=180+Math.random()*60;
    }
    update(){
      this.x+=this.vx;this.y+=this.vy;
      if(this.x<0||this.x>W)this.vx*=-1;
      if(this.y<0||this.y>H)this.vy*=-1;
      const dx=mouse.x-this.x,dy=mouse.y-this.y,d=Math.sqrt(dx*dx+dy*dy);
      if(d<150){this.x-=dx*.01;this.y-=dy*.01;}
    }
    draw(){
      ctx.beginPath();ctx.arc(this.x,this.y,this.r,0,Math.PI*2);
      ctx.fillStyle=`hsla(${this.hue},80%,70%,${this.a})`;ctx.fill();
    }
  }

  for(let i=0;i<COUNT;i++)particles.push(new P());

  function animate(){
    ctx.clearRect(0,0,W,H);
    particles.forEach(p=>{p.update();p.draw();});
    for(let i=0;i<particles.length;i++){
      for(let j=i+1;j<particles.length;j++){
        const dx=particles[i].x-particles[j].x,dy=particles[i].y-particles[j].y;
        const d=Math.sqrt(dx*dx+dy*dy);
        if(d<MAX_DIST){
          ctx.beginPath();ctx.moveTo(particles[i].x,particles[i].y);
          ctx.lineTo(particles[j].x,particles[j].y);
          ctx.strokeStyle=`rgba(34,211,238,${.12*(1-d/MAX_DIST)})`;
          ctx.lineWidth=.5;ctx.stroke();
        }
      }
    }
    requestAnimationFrame(animate);
  }
  animate();

  document.addEventListener('mousemove',e=>{mouse.x=e.clientX;mouse.y=e.clientY;});
  document.addEventListener('mouseleave',()=>{mouse.x=-999;mouse.y=-999;});
})();
