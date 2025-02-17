import React, { useContext } from 'react';
import { ItemsContext } from '../ItemsContext';
import { Link } from 'react-router-dom';

const ItemsList = () => {
const { items, deleteItem } = useContext(ItemsContext);

return (
    <div className='container'>
        <h2 className='title'>Liste des articles</h2>
        {items && items.length > 0 ? (
        <ul className='items-list'>
            <li className='liste header'>
                <strong>Nom</strong> <span style={{margin: "10px"}}>Quantité </span> Actions
            </li>
            {items.map(item => (
            <li className='liste' key={item.id}>
                <strong style={{marginRight: "50px"}}>{item.nom}</strong> {item.quantite}{' '}
            <div style={{display: "flex", justifyContent: "space-around"}}> 
                <Link className='btn' to={`/update/${item.id}`}>Modifier</Link>
                <button className='btn2' onClick={() => deleteItem(item.id)}>Supprimer</button>
            </div>
            </li>
            ))}
        </ul>
        ) : (
        <p>Aucun article trouvé.</p>
        )}
    </div>
);
};

export default ItemsList;
