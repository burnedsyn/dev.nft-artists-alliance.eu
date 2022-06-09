var web3;
const initialize = () => {
    //Section Actions Basique 
    const onboardButton = document.getElementById('connectButton');
  
    //function check metamask est installer
    const isMetaMaskInstalled = () => {
      //si l'objet ethereum existe alors c'est ok
      const { ethereum } = window;
      return Boolean(ethereum && ethereum.isMetaMask);
    };
  
    
    const MetaMaskClientCheck = () => {
      //on appelle le check installer
      if (!isMetaMaskInstalled()) {
        //si pas installé on l'invite a le faire
        onboardButton.value = 'Click here to install MetaMask!';
        onboardButton.onclick = onClickInstall;
        //on réactive le bouton
        onboardButton.disabled = false;
      } else {
        //si installer alors on invite a la connection
        onboardButton.value = 'Connect';
        onboardButton.onclick = onClickConnect;
    //on réactive le bouton
    onboardButton.disabled = false;
      }
    };
    MetaMaskClientCheck();
   
  };
  
  const onClickConnect = async () => {
    try {
      // Ouvre la fenetre modale de metamask
      const onboardButton = document.getElementById('connectButton');
      onboardButton.disabled=true;
      await ethereum.request({ method: 'eth_requestAccounts' });
      onboardButton.value = 'Connected';
      onboardButton.disabled = false;
    } catch (error) {
      console.error(error);
    }
  };


  
  window.addEventListener('DOMContentLoaded', initialize);


