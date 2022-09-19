
let confirmCommand = (e) => {
    let res = confirm('Are you sure!, this cannot be revoked.')
    if (res === true) {
        alert('true')
        console.log('choose no')
    }
    if (res === false) {
        alert('no')
        e.preventDefault();
        console.log('choose yes')
    }
}


// nav pages function
// what we will achieve is to
// show a particular page depending on the nav link that is selected
// first get all the elements of the nav and at the same time the elements of the display

let tabCollapse =(tabGroup,viewGroup,par)=>{
   let tab = document.querySelectorAll(`#${tabGroup}`)
   let view = document.querySelectorAll(`#${viewGroup}`)
    for (const x of tab) {
        x.onclick = ()=>{
            for (const y of tab) {
                if (y.classList.contains(par)){
                    // means y will be the currently selected element
                    // we will unselect the current y element
                    y.classList.remove(par);
                }
            }
            for (const m of view){
                if (m.classList.contains('collapse')){

                }else{
                    m.classList.add('collapse')
                }
                if(m.dataset.id == x.id){
                    m.classList.remove('collapse')
                }
            }
            x.classList.add(par)
        }
    }
}

tabCollapse('tabPanel>button', 'panelView>div', 'inview');
tabCollapse('tab>li','tabview>div','tab-active');
