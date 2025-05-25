import SemanticImage from "../molecules/SemanticImage";

const EventCard = ({ event }) => {
    const { title, description, date, location, image } = event;
    
    return (
        <article className="event-card">
            <SemanticImage src={image} alt={title} className="event-card-image" />
            <div className="event-card-content">
                <h3 className="event-card-title">{title}</h3>
                <div className="event-card-description">
                    <p className="event-card-description">{description}</p>
                </div>
                <div className="event-card-footer">
                    <p className="event-card-date">{date}</p>
                    <p className="event-card-location">{location}</p>
                </div>
                <button className="event-card-button">Learn More</button>
            </div>
        </article>
    );
}

export default EventCard;