import React, { useState, useContext } from 'react';
import { ItemsContext } from '../ItemsContext';
import { useNavigate } from 'react-router-dom';

const CreateItem = () => {
  const { createItem } = useContext(ItemsContext);
  const navigate = useNavigate();
  const [nom, setNom] = useState('');
  const [quantite, setQuantite] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    await createItem({ nom, quantite });
    navigate('/items');
  };

  return (
    <div className='container'>
      <form className='form' onSubmit={handleSubmit}>
      <h2 className='title'>Créer un nouvel article</h2>
        <div className=''>
          <label>Nom :</label>
          <input className='input' type="text" value={nom} onChange={(e) => setNom(e.target.value)} required />
        </div>
        <div>
          <label>Quantité :</label>
          <input className='input' type="text" value={quantite} onChange={(e) => setQuantite(e.target.value)} required />
        </div>
        <div style={{display: "flex", justifyContent: "center", width: "25%"}}>
        <button className='btn1' type="submit">Créer</button>
        </div>
      </form>
    </div>
  );
};

export default CreateItem;
