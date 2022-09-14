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
