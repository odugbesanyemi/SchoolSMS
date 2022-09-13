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
// user toggle effect
